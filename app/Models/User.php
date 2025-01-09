<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\CourseInfo;

class User extends Model
{
    protected $fillable = ['name', 'email', 'password', 'unique_id', 'google_id'];

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

    // public function profileCompletePercentage()
    // {
    //     $filledFields = 0;
    //     $totalFields = 0;

    //     foreach ($this->fillable as $field) {
    //         $totalFields++;
    //         if (!empty($this->$field)) {
    //             $filledFields++;
    //         }
    //     }

    //     if ($this->Academics) {
    //         $academicFields = [
    //             'gap_in_academics',
    //             'reason_for_gap',
    //             'work_experience',
    //             'ILETS',
    //             'GRE',
    //             'TOFEL',
    //             'Others',
    //             'university_school_name',
    //             'course_name'

    //         ];
    //         foreach ($academicFields as $field) {
    //             $totalFields++;
    //             if (!empty($this->address->$field)) {
    //                 $filledFields++;
    //             }
    //         }
    //     }

    //     $percentage = ($totalFields > 0) ? ($filledFields / $totalFields) * 100 : 0;
    //     return round($percentage,2)



    // }
}
