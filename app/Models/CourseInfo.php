<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseInfo extends Model
{
    protected $table = 'course_details_formdata';

    use HasFactory;
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'plan-to-study',
        'degree-type',
        'course-duration',
        'course-details',
        'loan_amount_in_lakhs',
    ];
    protected $casts = [
        'plan-to-study' => 'array',
        'degree-type' => 'string',
    ];



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'unique_id');  // user_id in PersonalInfo references id in User
    }
}