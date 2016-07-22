<?php namespace PasswordPolicy;

class Validator
{
    /**
     * @var Policy
     */
    protected $policy;

    public function __construct(Policy $policy)
    {
        $this->policy = $policy;
    }
    /**
     * @param Policy $policy
     *
     * @return $this
     */
    protected function setPolicy(Policy $policy)
    {
        $this->policy = $policy;

        return $this;
    }

    public function attempt($subject)
    {
        foreach ($this->policy->rules() as $rule) {
            if (!call_user_func_array($rule, [$subject])) {
                return false;
            }
        }

        return true;
    }
}
