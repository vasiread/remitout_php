<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requestprogress extends Model
{
    protected $table = 'traceprogress';
    protected $primaryKey = null;  
    public $incrementing = false; 


    use HasFactory;
    protected $fillable = ['nbfc_id', 'user_id', 'type','reviewed'];
 

    const TYPE_REQUEST = 'request';
    const TYPE_PROPOSAL = 'proposal';


    // In Requestprogress.php model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'unique_id');
        // If 'user_id' in Requestprogress refers to 'unique_id' in User
    }

    public function courseInfo()
    {
        return $this->belongsTo(CourseInfo::class, 'user_id', 'user_id');
    }


    public function nbfc()
    {
        return $this->belongsTo(Nbfc::class, 'nbfc_id', 'nbfc_id');
    }
}
