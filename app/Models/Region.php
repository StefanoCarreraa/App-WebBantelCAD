<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'slug', 
        'total_cad_a', 
        'total_cad_b', 
        'total_cau', 
        'status'
    ];

    /**
     * Una región tiene muchos CADs y CAUs.
     */
    public function centers()
    {
        return $this->hasMany(Center::class);
    }

    /**
     * Una región tiene muchas noticias.
     */
    public function news()
    {
        return $this->hasMany(News::class);
    }
}