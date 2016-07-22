<?php namespace PasswordPolicy\Tests;

use PasswordPolicy\Builder;
use PasswordPolicy\Policy;
use PasswordPolicy\Validator;


//        $policy->minLength(8)
//            ->doesNotContain(['josh', 'ralph'])
//            ->upperCase(1)
//            ->lowerCase(1)
//            ->didgit(1)
//            ->special(1);

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testMinLengthRule()
    {
        $policy = $this->policy()->minLength(6);
        $validator = new Validator($policy);

        $this->assertFalse($validator->attempt('short'));
        $this->assertTrue($validator->attempt('long enough'));
    }

    public function testDoesNotContainRule()
    {
        $policy = $this->policy()->doesNotContain('test');
        $validator = new Validator($policy);

        $this->assertFalse($validator->attempt('test'));
        $this->assertFalse($validator->attempt('keyword test surrounded'));
        $this->assertTrue($validator->attempt('nothing of the sort'));

        $policy = $this->policy()->doesNotContain(['test', 'word']);
        $validator = new Validator($policy);

        $this->assertFalse($validator->attempt('test'));
        $this->assertFalse($validator->attempt('keyword word surrounded'));
        $this->assertTrue($validator->attempt('nothing of the sort'));

        $policy = $this->policy()->doesNotContain('test', 'word');
        $validator = new Validator($policy);

        $this->assertFalse($validator->attempt('test'));
        $this->assertFalse($validator->attempt('keyword word surrounded'));
        $this->assertTrue($validator->attempt('nothing of the sort'));
    }

    public function testUpperCase()
    {
        $policy = $this->policy()->upperCase();
        $validator = new Validator($policy);

        $this->assertFalse($validator->attempt('example'));
        $this->assertTrue($validator->attempt('Example'));

        $policy = $this->policy()->upperCase(3);
        $validator = new Validator($policy);

        $this->assertFalse($validator->attempt('Example'));
        $this->assertTrue($validator->attempt('ExAmPle'));
        $this->assertTrue($validator->attempt('ExAmPlE'));
    }

    public function testLowerCase()
    {
        $policy = $this->policy()->lowerCase();
        $validator = new Validator($policy);

        $this->assertFalse($validator->attempt('EXAMPLE'));
        $this->assertTrue($validator->attempt('EXAmPLE'));

        $policy = $this->policy()->lowerCase(3);
        $validator = new Validator($policy);

        $this->assertFalse($validator->attempt('EXAmPLE'));
        $this->assertTrue($validator->attempt('EXampLE'));
        $this->assertTrue($validator->attempt('Example'));
    }

    public function testDigits()
    {
        $policy = $this->policy()->digits();
        $validator = new Validator($policy);

        $this->assertFalse($validator->attempt('no digits'));
        $this->assertTrue($validator->attempt('123'));
        $this->assertTrue($validator->attempt('abc123'));

        $policy = $this->policy()->digits(3);
        $validator = new Validator($policy);

        $this->assertFalse($validator->attempt('test1'));
        $this->assertTrue($validator->attempt('test123'));
        $this->assertTrue($validator->attempt('aAd981237aj'));
    }

    protected function policy()
    {
        return new Policy;
    }
}
