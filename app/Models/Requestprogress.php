<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requestprogress extends Model
{
    protected $table = 'traceprogress';

    use HasFactory;
    protected $fillable = ['nbfc_id', 'user_id', 'type'];
 

    const TYPE_REQUEST = 'request';
    const TYPE_PROPOSAL = 'proposal';

    

}
