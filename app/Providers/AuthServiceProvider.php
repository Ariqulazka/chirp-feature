<?php

namespace App\Providers;

use App\Models\Report;
use App\Policies\ReportPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Report::class => ReportPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Daftarkan gate atau aturan otorisasi tambahan jika diperlukan
        Gate::define('viewAny', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('update', function ($user, Report $report) {
            return $user->hasRole('admin');
        });
    }
}
