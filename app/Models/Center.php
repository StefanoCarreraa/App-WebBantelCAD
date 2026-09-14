<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    use HasFactory;

    protected $table = 'centros';

    protected $fillable = [
        'region_id', 'code', 'type', 'name', 'province', 
        'district', 'locality', 'address', 'latitude', 'longitude', 
        'schedule', 'services', 'phone', 'email', 'facebook_url', 
        'image_path', 'status'
    ];

    /**
     * Un centro pertenece a una región.
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Un centro tiene muchas actividades (Agenda).
     */
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}