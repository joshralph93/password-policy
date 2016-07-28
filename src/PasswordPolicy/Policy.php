<?php namespace PasswordPolicy;

class Policy
{
    private $rules = [];

    public function addRule(Rule $rule)
    {
        $this->rules[] = $rule;
    }

    public function rules()
    {
        return $this->rules;
    }
}
