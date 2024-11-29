<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'full_name',
        'phone',
        'referral_code',
        'email',
        'state'
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastUser = self::latest('id')->first();
            $lastId = optional($lastUser)->id ?? 0;
            $nextId = str_pad($lastId + 1, 7, '0', STR_PAD_LEFT);  // Pad the ID with leading zeros
            $model->user_id = 'HBNKJI' . $nextId;
            echo $model->user_id+"--------->";
        });
    }
}
