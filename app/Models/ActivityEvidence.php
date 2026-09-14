<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityEvidence extends Model
{
    use HasFactory;

    protected $table = 'activity_evidences';

    protected $fillable = [
        'activity_id',
        'file_path',
        'file_type',
        'caption',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
}