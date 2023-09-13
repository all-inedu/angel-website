<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpeakingOpportunities extends Model
{
    use HasFactory;

    protected $table = "tb_speaking_opportunities";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'title',
        'video_link',
        'image',
        'alt',
        'description',
        'is_highlight',
        'event_date',
        'created_at',
        'updated_at'
    ];
}
