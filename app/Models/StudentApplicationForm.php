<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentApplicationForm extends Model
{
    protected $table = 'student_application_forms';

    protected $fillable = [
        'section_name',
        'section_slug',
        'data'
    ];

    protected $casts = [
        'data' => 'array'
    ];
}