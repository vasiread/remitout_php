<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        
    }

    public function boot()
    {

        if (app()->environment('production') && Schema::hasTable('users')) {
            if (!User::where('role', 'superadmin')->exists()) {
                Artisan::call('db:seed', [
                    '--class' => 'SuperAdminSeeder',
                    '--force' => true
                ]);
            }
        }
    }
}
