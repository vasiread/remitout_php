<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queries extends Model
{
    use HasFactory;

    protected $table = 'queryraised';
    protected $fillable=['scuserid','querytype','queryraised','status','is_reviewed'];
    

}
