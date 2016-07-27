<?php namespace PasswordPolicy\Tests;

use Mockery\Mock;
use PasswordPolicy\Policy;
use PasswordPolicy\PolicyBuilder;
use PasswordPolicy\Rule;
use PasswordPolicy\Rules\LengthRule;

class PolicyBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    function it_tests_min_length_can_be_added_to_a_policy()
    {
        $mock = \Mockery::mock(Policy::class)
            ->shouldReceive('addRule')
            ->with(\Mockery::type(LengthRule::class))
            ->mock();

        $builder = new PolicyBuilder($mock);
        $builder->minLength(2);
    }

    protected function tearDown()
    {
        \Mockery::close();
    }
}
