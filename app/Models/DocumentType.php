<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'key'];

    public function userDocuments()
    {
        return $this->hasMany(UserDocument::class);
    }
}
