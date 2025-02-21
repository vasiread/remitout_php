<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scuser extends Model
{
    use HasFactory;

    protected $table = 'studentcounsellorlist';

    protected $primaryKey = 'referral_code';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'referral_code',
        'full_name',
        'dob',
        'phone',
        'email',
        'address',
        'start_date',
        'passwordField',
        'street',
        'district',
        'state',
        'pincode'
    ];
}
