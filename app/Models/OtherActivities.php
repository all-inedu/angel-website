<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherActivities extends Model
{
    use HasFactory;

    protected $table = "tb_other_activities";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'organization_name',
        'roles',
        'start_date',
        'end_date',
        'image',
        'alt',
        'description',
        'brief_description',
        'is_highlight',
        'created_at',
        'updated_at'
    ];
}
