<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $fillable = [
        'admin_id',
        'name',
        'email',
        'password',
        'is_super_admin',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_super_admin' => 'boolean',
    ];
    use HasFactory;
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($admin) {
            if (empty($admin->admin_id)) {
                $latestAdmin = static::orderBy('id', 'desc')->first();
                $nextNumber = $latestAdmin ? (int) substr($latestAdmin->admin_id, 3) + 1 : 1;
                $admin->admin_id = 'ADM' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}
