<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requestedbyusers extends Model
{
    use HasFactory;

    protected $table = 'requestedbyusers';
    protected $fillable = ['userid', 'nbfcid'];
}
