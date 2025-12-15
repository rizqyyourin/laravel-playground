<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProgress extends Model
{
    protected $fillable = [
        'user_id',
        'tutorial_id',
        'completed_at',
        'progress_percentage',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'progress_percentage' => 'integer',
    ];

    /**
     * Get the user that owns the progress
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the tutorial that this progress belongs to
     */
    public function tutorial()
    {
        return $this->belongsTo(Tutorial::class);
    }
}
