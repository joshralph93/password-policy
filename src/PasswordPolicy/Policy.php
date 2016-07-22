<?php namespace PasswordPolicy;

class Policy
{
    protected $rules = [];

    public function minLength($length)
    {
        return $this->pattern(sprintf('.{%d,}', $length));
    }

    public function doesNotContain($phrases)
    {
        $phrases = is_array($phrases) ? $phrases : func_get_args();

        return $this->closure(function ($subject) use ($phrases) {
            foreach ($phrases as $phrase) {
                if (strpos($subject, $phrase) !== false) {
                    return false;
                }
            }

            return true;
        });
    }

    public function upperCase($min = 1)
    {
        return $this->patternMin(sprintf('[A-Z]'), $min);
    }

    public function lowerCase($min = 1)
    {
        return $this->patternMin(sprintf('[a-z]'), $min);
    }

    public function digits($min = 1)
    {
        return $this->patternMin(sprintf('[0-9]'), $min);
    }

    public function pattern($pattern, $flags = '')
    {
        return $this->closure(function ($subject) use ($pattern, $flags) {
            return preg_match("/{$pattern}/{$flags}", $subject);
        });
    }

    public function patternMin($pattern, $min = 1, $flags = '')
    {
        return $this->closure(function ($subject) use ($pattern, $min, $flags) {
            return preg_match_all("/{$pattern}/{$flags}", $subject) >= $min;
        });
    }

    public function closure(\Closure $closure)
    {
        $this->rules[] = $closure;

        return $this;
    }

    public function rules()
    {
        return $this->rules;
    }


}
