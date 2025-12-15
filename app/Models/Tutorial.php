<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    protected $fillable = [
        'package_id',
        'title',
        'slug',
        'content',
        'order',
        'estimated_time',
    ];

    protected $casts = [
        'order' => 'integer',
        'estimated_time' => 'integer',
    ];

    /**
     * Get the package that owns the tutorial
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Get all code examples for this tutorial
     */
    public function codeExamples()
    {
        return $this->hasMany(CodeExample::class);
    }

    /**
     * Get all user progress records for this tutorial
     */
    public function userProgress()
    {
        return $this->hasMany(UserProgress::class);
    }
}
