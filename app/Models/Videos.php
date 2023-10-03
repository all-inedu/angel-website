<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    use HasFactory;

    protected $table = "tb_videos";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'title',
        'video',
        'is_highlight',
        'created_at',
        'updated_at'
    ];
}
