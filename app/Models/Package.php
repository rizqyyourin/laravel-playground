<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'composer_package',
        'documentation_url',
        'github_url',
        'difficulty_level',
        'is_official',
        'popularity_score',
    ];

    protected $casts = [
        'is_official' => 'boolean',
        'popularity_score' => 'integer',
    ];

    /**
     * Get the category that owns the package
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all tutorials for this package
     */
    public function tutorials()
    {
        return $this->hasMany(Tutorial::class);
    }
}
