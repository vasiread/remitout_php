<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academics extends Model
{
    protected $table = 'academic_details';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'gap_in_academics',
        'reason_for_gap',
        'work_experience',
        'ILETS',
        'GRE',
        'TOFEL',
        'Others'
    ];
    use HasFactory;



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'unique_id');  // user_id in PersonalInfo references id in User
    }
}
