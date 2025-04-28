<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    use HasFactory;
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id',
        'full_name',
        'gender',
        'dob',
        'referral_code',
        'email',
        'state',
        'city',
        'linked_through',
        'created_at'


    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'unique_id');  // user_id in PersonalInfo references id in User
    }
    public function courseInfo()
    {
        return $this->hasOne(CourseInfo::class, 'user_id', 'user_id');
    }

}
