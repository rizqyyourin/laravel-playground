<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TutorialResource;
use App\Models\Tutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TutorialController extends Controller
{
    /**
     * Display tutorials for a specific package
     */
    public function index(Request $request)
    {
        $query = Tutorial::with('package')
            ->withCount('codeExamples');

        // Filter by package
        if ($request->has('package')) {
            $query->whereHas('package', function ($q) use ($request) {
                $q->where('slug', $request->package);
            });
        }

        $tutorials = $query->orderBy('order')->get();

        return TutorialResource::collection($tutorials);
    }

    /**
     * Store a newly created tutorial
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'order' => 'integer|min:0',
            'estimated_time' => 'nullable|integer|min:1',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        $tutorial = Tutorial::create($validated);

        return new TutorialResource($tutorial->load('package'));
    }

    /**
     * Display the specified tutorial with code examples
     */
    public function show(string $slug)
    {
        $tutorial = Tutorial::where('slug', $slug)
            ->with([
                'package',
                'codeExamples' => function ($query) {
                    $query->orderBy('order');
                }
            ])
            ->withCount('codeExamples')
            ->firstOrFail();

        return new TutorialResource($tutorial);
    }

    /**
     * Update the specified tutorial
     */
    public function update(Request $request, string $slug)
    {
        $tutorial = Tutorial::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'package_id' => 'sometimes|exists:packages,id',
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
            'order' => 'integer|min:0',
            'estimated_time' => 'nullable|integer|min:1',
        ]);

        if (isset($validated['title'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $tutorial->update($validated);

        return new TutorialResource($tutorial->load('package'));
    }

    /**
     * Remove the specified tutorial
     */
    public function destroy(string $slug)
    {
        $tutorial = Tutorial::where('slug', $slug)->firstOrFail();
        $tutorial->delete();

        return response()->json(['message' => 'Tutorial deleted successfully'], 200);
    }
}
