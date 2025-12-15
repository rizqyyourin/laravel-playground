<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories with package counts
     */
    public function index()
    {
        $categories = Category::withCount('packages')
            ->orderBy('order')
            ->get();

        return CategoryResource::collection($categories);
    }

    /**
     * Display the specified category with its packages
     */
    public function show(string $slug)
    {
        $category = Category::where('slug', $slug)
            ->with([
                'packages' => function ($query) {
                    $query->orderBy('popularity_score', 'desc');
                }
            ])
            ->withCount('packages')
            ->firstOrFail();

        return new CategoryResource($category);
    }
}
