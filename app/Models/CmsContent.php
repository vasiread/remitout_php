<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsContent extends Model
{
    use HasFactory;
     protected $fillable = [
        'page', 'section', 'title', 'key_name', 'content',
        'status', 'type', 'constraints'
    ];

    protected $casts = [
        'constraints' => 'array',
    ];
}
