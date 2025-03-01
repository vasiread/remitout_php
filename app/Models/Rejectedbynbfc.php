<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rejectedbynbfc extends Model
{
    use HasFactory;

    protected $table = 'rejectedbynbfc';
    protected $fillable = ['nbfc_id', 'user_id', 'Remarks'];


}
