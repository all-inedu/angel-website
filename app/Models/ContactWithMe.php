<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactWithMe extends Model
{
    use HasFactory;

    protected $table = "tb_contact_with_me";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'contact_number',
        'email',
        'message',
        'created_at',
        'updated_at'
    ];
}
