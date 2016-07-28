<?php namespace PasswordPolicy;

use InvalidArgumentException;

/**
 * Class PolicyManager
 *
 * @package PasswordPolicy
 */
class PolicyManager
{
    /**
     * Array of defined policies
     *
     * @var array
     */
    private $policies = [];

    /**
     * Default policy name
     *
     * @var string
     */
    private static $defaultPolicy = 'default';


    /**
     * Set the name of the default policy
     *
     * @param $name string
     *
     * @return $this
     */
    public function setDefaultName($name)
    {
        static::$defaultPolicy = $name;

        return $this;
    }

    /**
     * Get the name of the default policy
     *
     * @return string
     */
    public function getDefaultName()
    {
        return static::$defaultPolicy;
    }

    /**
     * Define a new policy by name
     *
     * @param $name string
     * @param $policy Policy
     *
     * @return $this
     */
    public function define($name, Policy $policy)
    {
        $this->policies[$name] = $policy;

        return $this;
    }

    /**
     * Get a new validator instance for the given policy name
     *
     * @param $policy string
     *
     * @return Validator
     */
    public function validator($policy)
    {
        return new Validator($this->resolve($policy));
    }

    /**
     * Resolve a policy
     *
     * @param $policy Policy|string
     *
     * @throws InvalidArgumentException
     * @return Policy
     */
    protected function resolve($policy)
    {
        if ($policy instanceof Policy) {
            return $policy;
        }

        return $this->getPolicy($policy);
    }

    /**
     * Check whether a given policy exists
     *
     * @param $name string
     *
     * @return bool
     */
    public function policyExists($name)
    {
        return isset($this->policies[$name]);
    }

    /**
     * Get a policy by name. Throws an exception if policy is not found.
     *
     * @param $name string
     *
     * @throws InvalidArgumentException
     * @return Policy
     */
    public function getPolicy($name)
    {
        if ($this->policyExists($name)) {
            return $this->policies[$name];
        }

        throw new InvalidArgumentException("Password policy [{$name}] does not exist.");
    }
}