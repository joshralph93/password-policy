<?php namespace PasswordPolicy;

class Policy
{
    protected $rules = [];

    public function addRule(Rule $rule)
    {
        $this->rules[] = $rule;
    }
}
