<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PackageResource;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    /**
     * Display a listing of packages with filtering and search
     */
    public function index(Request $request)
    {
        $query = Package::with('category')
            ->withCount('tutorials');

        // Filter by category
        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by difficulty level
        if ($request->has('difficulty')) {
            $query->where('difficulty_level', $request->difficulty);
        }

        // Filter by official packages only
        if ($request->boolean('official')) {
            $query->where('is_official', true);
        }

        // Search by name or description
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'popularity_score');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $packages = $query->paginate($request->get('per_page', 15));

        return PackageResource::collection($packages);
    }

    /**
     * Store a newly created package
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'composer_package' => 'nullable|string|max:255',
            'documentation_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'difficulty_level' => 'required|in:beginner,intermediate,advanced',
            'is_official' => 'boolean',
            'popularity_score' => 'integer|min:0|max:100',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $package = Package::create($validated);

        return new PackageResource($package->load('category'));
    }

    /**
     * Display the specified package with tutorials
     */
    public function show(string $slug)
    {
        $package = Package::where('slug', $slug)
            ->with([
                'category',
                'tutorials' => function ($query) {
                    $query->orderBy('order');
                }
            ])
            ->withCount('tutorials')
            ->firstOrFail();

        return new PackageResource($package);
    }

    /**
     * Update the specified package
     */
    public function update(Request $request, string $slug)
    {
        $package = Package::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'category_id' => 'sometimes|exists:categories,id',
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'composer_package' => 'nullable|string|max:255',
            'documentation_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'difficulty_level' => 'sometimes|in:beginner,intermediate,advanced',
            'is_official' => 'boolean',
            'popularity_score' => 'integer|min:0|max:100',
        ]);

        if (isset($validated['name'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $package->update($validated);

        return new PackageResource($package->load('category'));
    }

    /**
     * Remove the specified package
     */
    public function destroy(string $slug)
    {
        $package = Package::where('slug', $slug)->firstOrFail();
        $package->delete();

        return response()->json(['message' => 'Package deleted successfully'], 200);
    }
}
