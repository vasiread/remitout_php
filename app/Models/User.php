<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

use App\Models\CourseInfo;

class User extends Model
{
    protected $fillable = ['name','gender','dob','email', 'phone', 'password', 'unique_id', 'google_id','referral_code'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            do {
                $randomNumber = random_int(1000000, 9999999); 
                $uniqueId = 'HBNKJI' . $randomNumber;
            } while (self::where('unique_id', $uniqueId)->exists());

            $model->unique_id = $uniqueId;
        });


    }

    public function personalInfo()
    {
        return $this->hasOne(PersonalInfo::class, 'user_id', 'unique_id');
    }

    public function courseInfo()
    {
        return $this->hasMany(CourseInfo::class, 'user_id', 'unique_id');
    }

}
