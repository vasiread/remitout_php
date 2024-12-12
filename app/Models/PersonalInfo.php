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
        'phone',
        'referral_code',
        'email',
        'state',
        'linked_through'

    ];
 
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'unique_id');  // user_id in PersonalInfo references id in User
    }
}
