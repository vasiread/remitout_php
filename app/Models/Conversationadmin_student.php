<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversationadmin_student extends Model
{

    protected $table = 'admin_student_conversation';

    protected $fillable = ['student_id', 'admin_id'];

    use HasFactory;
    public function messages()
    {
        return $this->hasMany(Messageadminstudent::class, 'conversation_id');  // Specify the foreign key column explicitly if needed
    }
}
