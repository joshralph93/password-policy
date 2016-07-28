<?php namespace PasswordPolicy\Providers\Laravel;

use Illuminate\Support\ServiceProvider;
use PasswordPolicy\PolicyManager;

/**
 * Class Laravel5ServiceProvider
 *
 * @package PasswordPolicy\Providers\Laravel
 */
class Laravel5ServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerManager();
    }

    /**
     * Boot the service provider
     *
     * @return void
     */
    public function boot()
    {
        $this->configureValidationRule();
    }

    /**
     * Register the policy manager within the Laravel container
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton(PolicyManager::class);
    }

    /**
     * Configure custom Laravel validation rule
     *
     * @return void
     */
    protected function configureValidationRule()
    {
        $this->app['validator']->extend('password', PasswordValidator::class);
    }
}