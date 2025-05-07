<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanToCountry extends Model
{
    use HasFactory;
    protected $table = 'plan_to_countries';  

    protected $fillable = ['country_name'];
}
