<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposals extends Model
{
    use HasFactory;

    protected $table = 'proposals';

    protected $fillable = ['nbfc_id', 'student_id', 'remarks', 'status_modified_by_students']; // Fix column name

    const PENDING = 'Pending';
    const ACCEPTED = 'Accepted';
}
