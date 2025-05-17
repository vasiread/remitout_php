<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdditionalFieldValue extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'field_id', 'value'];

    public function field()
    {
        return $this->belongsTo(AdditionalField::class, 'field_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
