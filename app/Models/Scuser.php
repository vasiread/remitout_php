<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scuser extends Model
{
    protected $table = 'studentcounsellorlist';
    use HasFactory;
    protected $primaryKey = 'referral_code';
    protected $fillable = [
        'referral_code',
        'full_name',
        'dob',
        'phone',
        'email',
        'address'

    ];


}
