<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'noticias';

    protected $fillable = [
        'region_id',
        'center_id',
        'title',
        'slug',
        'summary',
        'content',
        'main_image',
        'published_at',
        'status',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Una noticia pertenece a una región.
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Una noticia puede estar asociada opcionalmente a un centro específico.
     */
    public function center()
    {
        return $this->belongsTo(Center::class);
    }
}