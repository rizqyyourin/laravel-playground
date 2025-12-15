<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Packages routes - require authentication
Route::middleware('auth')->group(function () {
    Route::get('/packages', function (Illuminate\Http\Request $request) {
        $packages = \App\Models\Package::with('category')
            ->withCount('tutorials')
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->when($request->category, function ($query, $category) {
                $query->whereHas('category', function ($q) use ($category) {
                    $q->where('slug', $category);
                });
            })
            ->when($request->difficulty, function ($query, $difficulty) {
                $query->where('difficulty_level', $difficulty);
            })
            ->orderBy('popularity_score', 'desc')
            ->paginate(12);

        $categories = \App\Models\Category::withCount('packages')->orderBy('order')->get();

        return Inertia::render('Packages/Index', [
            'packages' => $packages,
            'categories' => $categories,
            'filters' => $request->only(['search', 'category', 'difficulty']),
        ]);
    })->name('packages.index');

    Route::get('/packages/{slug}', function (string $slug) {
        $package = \App\Models\Package::where('slug', $slug)
            ->with([
                'category',
                'tutorials' => function ($query) {
                    $query->orderBy('order');
                }
            ])
            ->withCount('tutorials')
            ->firstOrFail();

        return Inertia::render('Packages/Show', [
            'package' => $package,
        ]);
    })->name('packages.show');

    Route::get('/tutorials/{slug}', function (string $slug) {
        $tutorial = \App\Models\Tutorial::where('slug', $slug)
            ->with([
                'package.category',
                'codeExamples' => function ($query) {
                    $query->orderBy('order');
                }
            ])
            ->firstOrFail();

        return Inertia::render('Tutorials/Show', [
            'tutorial' => $tutorial,
        ]);
    })->name('tutorials.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
