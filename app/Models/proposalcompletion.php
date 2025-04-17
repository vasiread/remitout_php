<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class proposalcompletion extends Model
{


    use HasFactory;
    public $timestamps = true;

    protected $table = 'proposalcompletion';
    protected $fillable = ['user_id', 'nbfc_id', 'proposal_accept']; 






    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'unique_id');
    }


    public function nbfc()
    {
        return $this->belongsTo(Nbfc::class, 'nbfc_id', 'nbfc_id');
    }
}

