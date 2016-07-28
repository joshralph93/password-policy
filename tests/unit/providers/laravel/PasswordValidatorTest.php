<?php namespace PasswordPolicy\Tests\Providers\Laravel;

use PasswordPolicy\Policy;
use PasswordPolicy\PolicyBuilder;
use PasswordPolicy\PolicyManager;
use PasswordPolicy\Providers\Laravel\PasswordValidator;
use PasswordPolicy\Validator;
use Mockery as m;

class PasswordValidatorTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_calls_the_validator_using_the_default_policy()
    {
        $managerMock = m::mock(PolicyManager::class)
            ->shouldReceive('validator')
            ->once()
            ->andReturn(m::type(Validator::class))->getMock();

        $validatorMock = m::mock(PasswordValidator::class, [$managerMock]);
        $validatorMock->shouldReceive('validate')->once()->with('password', 'password', [], null)->andReturn(true);

        $this->assertTrue($validatorMock->validate('password', 'password', [], null));
    }
}