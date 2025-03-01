<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nbfc extends Model
{
    use HasFactory;

    protected $table = 'nbfc';
    protected $fillable = [
        'nbfc_id',
        'nbfc_email',
        'password',
        'nbfc_name',
        'nbfc_description',
        'nbfc_type',


    ];
}
