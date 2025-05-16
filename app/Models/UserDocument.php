<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'document_type_id', 'file_url', 'file_name'];

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }
}
