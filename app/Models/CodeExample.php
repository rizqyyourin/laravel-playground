<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodeExample extends Model
{
    protected $fillable = [
        'tutorial_id',
        'title',
        'description',
        'code',
        'language',
        'order',
        'is_runnable',
    ];

    protected $casts = [
        'is_runnable' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Get the tutorial that owns the code example
     */
    public function tutorial()
    {
        return $this->belongsTo(Tutorial::class);
    }
}
