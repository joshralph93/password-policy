<?php namespace PasswordPolicy\Providers\Laravel;

use Illuminate\Support\ServiceProvider;
use PasswordPolicy\PolicyBuilder;
use PasswordPolicy\PolicyManager;

/**
 * Class PasswordPolicyServiceProvider
 *
 * @package PasswordPolicy\Providers\Laravel
 */
class PasswordPolicyServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerManager();
        $this->registerBuilder();
    }

    /**
     * Boot the service provider
     *
     * @return void
     */
    public function boot()
    {
        $this->defineDefaultPolicy();
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
     * Register policy builder
     *
     * @return void
     */
    protected function registerBuilder()
    {
        $this->app->bind(PolicyBuilder::class);
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

    /**
     * Define the default password policy
     *
     * @return void
     */
    protected function defineDefaultPolicy()
    {
        $defaultPolicy = $this->defaultPolicy($this->app->make(PolicyBuilder::class));

        if ($defaultPolicy instanceof PolicyBuilder) {
            $defaultPolicy = $defaultPolicy->getPolicy();
        }

        $this->app->make(PolicyManager::class)->define('default', $defaultPolicy);
    }

    /**
     * Build the default policy instance
     *
     * @param PolicyBuilder $builder
     *
     * @return \PasswordPolicy\Policy
     */
    protected function defaultPolicy(PolicyBuilder $builder)
    {
        return $builder->minLength(3)->getPolicy();
    }
}