<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->runningUnitTests()) {
            Auth::login(User::factory()->create());
        }else{
            if (!Auth::check()) {
                $user = User::first();
                if (!$user) {
                    $user = User::factory()->create();
                }
                Auth::login($user);
            }
        }
    }
}
