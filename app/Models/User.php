<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\CourseInfo;

class User extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'password', 'unique_id', 'google_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $lastUser = self::latest('id')->first();
            $lastId = optional($lastUser)->id ?? 0;
            $nextId = str_pad($lastId + 1, 7, '0', STR_PAD_LEFT);
            $model->unique_id = 'HBNKJI' . $nextId;
        });
    }

}
