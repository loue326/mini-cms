<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
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
        Model::preventLazyLoading(! app()->isProduction());

        Gate::define('manage-categories', fn (User $user) => $user->isAdmin());
        Gate::define('manage-tags', fn (User $user) => $user->isAdmin());

        Gate::before(function (User $user, string $ability): ?bool {
            if ($user->isAdmin() && $ability !== 'changeRole') {
                return true;
            }

            return null;
        });
    }
}
