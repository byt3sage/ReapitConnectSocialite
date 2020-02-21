<?php

namespace JaeTooleDev\ReapitConnectSocialite;

use Illuminate\Support\ServiceProvider;
use JaeTooleDev\ReapitConnectSocialite\Provider as RCProvider;

class ReapitConnectSocialiteProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('JaeTooleDev\ReapitConnectSocialite\ReapitConnectLoginController');
        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->bootReapitSocialite();
    }

    private function bootReapitSocialite()
    {
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'reapit_connect',
            function ($app) use ($socialite) {
                $config = $app['config']['services.reapit_connect'];
                return $socialite->buildProvider(RCProvider::class, $config);
            }
        );
    }
}
