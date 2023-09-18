<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    protected $table = "tb_projects";
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
        'button_title',
        'button_link',
        'is_highlight',
        'created_at',
        'updated_at'
    ];
}
