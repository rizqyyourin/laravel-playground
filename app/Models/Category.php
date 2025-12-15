<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'order',
    ];

    /**
     * Get all packages in this category
     */
    public function packages()
    {
        return $this->hasMany(Package::class);
    }
}
