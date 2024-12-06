<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseInfo extends Model
{
    protected $table = 'course_details_formdata';

    use HasFactory;
    protected $fillable = [
        'plan_to_study',
        'degree_type',
        'course_duration',
        'course_details',
        'loan_amount_in_lakhs',
        'user_id'
    ];


      public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'unique_id');  // user_id in PersonalInfo references id in User
    }
}
