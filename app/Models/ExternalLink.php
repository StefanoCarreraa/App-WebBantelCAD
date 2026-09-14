<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExternalLink extends Model
{
    protected $fillable = [
        'region_id',
        'category',
        'title',
        'url',
        'is_active',
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }
}