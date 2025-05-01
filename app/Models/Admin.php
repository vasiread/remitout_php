<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_super_admin',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_super_admin' => 'boolean',
    ];


    use HasFactory;
}
