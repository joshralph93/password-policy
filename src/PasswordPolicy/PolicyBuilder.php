<?php namespace PasswordPolicy;

use PasswordPolicy\Rules\CaseRule;
use PasswordPolicy\Rules\ContainRule;
use PasswordPolicy\Rules\DigitRule;
use PasswordPolicy\Rules\LengthRule;

/**
 * Class PolicyBuilder
 *
 * @package PasswordPolicy
 */
class PolicyBuilder
{
    /**
     * Policy instance
     *
     * @var Policy
     */
    private $policy;


    /**
     * PolicyBuilder constructor.
     *
     * @param Policy $policy
     */
    public function __construct(Policy $policy)
    {
        $this->policy = $policy;
    }

    /**
     * Add a min length rule
     *
     * @param $length int
     *
     * @return $this
     */
    public function minLength($length)
    {
        $this->policy->addRule(
            (new LengthRule)->min($length)
        );

        return $this;
    }

    /**
     * Add a max length rule
     *
     * @param $length int
     *
     * @return $this
     */
    public function maxLength($length)
    {
        $this->policy->addRule(
            (new LengthRule)->max($length)
        );

        return $this;
    }

    public function contains($phrases)
    {
        $phrases = is_array($phrases) ? $phrases : func_get_args();

        $this->policy->addRule(
            (new ContainRule)->phrase($phrases)
        );

        return $this;
    }

    public function doesNotContain($phrases)
    {
        $phrases = is_array($phrases) ? $phrases : func_get_args();

        $this->policy->addRule(
            (new ContainRule)->phrase($phrases)->doesnt()
        );

        return $this;
    }

    public function upperCase($min = 1)
    {
        $this->policy->addRule(
            (new CaseRule)->upper($min)
        );

        return $this;
    }

    public function lowerCase($min = 1)
    {
        $this->policy->addRule(
            (new CaseRule)->lower($min)
        );

        return $this;
    }

    public function digits($min = 1)
    {
        $this->policy->addRule(
            (new DigitRule)->min($min)
        );

        return $this;
    }

    public function getPolicy()
    {
        return $this->policy;
    }
}
