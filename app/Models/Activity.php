<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'actividades';

    protected $fillable = [
        'center_id',
        'title',
        'description',
        'start_datetime',
        'end_datetime',
        'status',
        'responsable_name',
        'attendees_count',
    ];

    protected $casts = [
        'start_datetime' => 'datetime',
        'end_datetime'   => 'datetime',
    ];

    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    public function evidences()
    {
        return $this->hasMany(ActivityEvidence::class, 'activity_id');
    }
}