<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecentSearch extends Model
{
    protected $fillable = [
        'user_id',
        'query',
        'results_count',
        'searched_at'
    ];

    protected $casts = [
        'searched_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}