<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalField extends Model
{
    use HasFactory;
    protected $fillable = ['label', 'name', 'type', 'required','options','section'];

    protected $casts = [
        'options' => 'array',
        'required' => 'boolean',
    ];
}
