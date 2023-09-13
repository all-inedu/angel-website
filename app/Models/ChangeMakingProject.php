<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeMakingProject extends Model
{
    use HasFactory;

    protected $table = "tb_change_making_projects";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'organization_name',
        'roles',
        'description',
        'button_title',
        'button_link',
        'is_highlight',
        'end_date',
        'created_at',
        'updated_at'
    ];
}
