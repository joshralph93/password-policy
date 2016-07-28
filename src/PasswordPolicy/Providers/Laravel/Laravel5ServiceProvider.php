<?php namespace PasswordPolicy\Providers\Laravel;

use Illuminate\Support\ServiceProvider;
use PasswordPolicy\PolicyManager;

class Laravel5ServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->configureValidationRule();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerManager();
    }

    private function configureValidationRule()
    {
        $this->app['validator']->extend('password', PasswordValidator::class);
    }

    private function registerManager()
    {
        $this->app->singleton(PolicyManager::class);
    }
}