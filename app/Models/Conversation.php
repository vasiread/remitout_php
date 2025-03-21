<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
    protected $fillable = ['nbfc_id', 'student_id'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
