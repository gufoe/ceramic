<?php

namespace App\Providers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::viaRequest('custom-token', function ($request) {
            $session = \App\Session::where('token', http_token())->where('expires_at', '>=', to_datetime('now'))->first();
            if (!$session) return;


            $user = $session->user;
            $user->update([
                'seen_at' => to_datetime('now'),
            ]);

            if ($session->expires_at < to_datetime('+4 hours')) {
                $session->update([
                    'expires_at' => to_datetime('+4 hours'),
                ]);
            }
            return $user;
        });
    }
}
