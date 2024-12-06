<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\CourseInfo;
// use App\Models\PersonalInfo;

class User extends Model
{
    protected $fillable = ['name', 'email', 'password', 'unique_id'];

    // Automatically generate unique_id when a new record is created
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastUser = self::latest('id')->first();  // Get the latest user record
            $lastId = optional($lastUser)->id ?? 0;  // Get the last user ID or 0 if no record exists
            $nextId = str_pad($lastId + 1, 7, '0', STR_PAD_LEFT);  // Pad the ID with leading zeros
            $model->unique_id = 'HBNKJI' . $nextId;  // Create the unique_id
        });
    }

    public function personalInfo()
    {
        return $this->hasOne(PersonalInfo::class, 'user_id', 'unique_id');
    }
    public function courseInfo(){
        return $this->hasOne(CourseInfo::class, 'user_id', 'unique_id');
    }
}
