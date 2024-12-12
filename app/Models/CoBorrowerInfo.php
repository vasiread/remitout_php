<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoBorrowerInfo extends Model
{
    use HasFactory;
    protected $table = 'coborrower_details';
    protected $fillable = [
        'user_id',
        'co_borrower_relation',
        'co_borrower_income',
        'co_borrower_monthly_liability',
       
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'unique_id'); 
    }
}
