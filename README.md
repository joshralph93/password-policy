[![Build Status](https://api.travis-ci.org/joshralph93/password-policy.svg?branch=master)](https://travis-ci.org/joshralph93/password-policy)

A fluent password policy builder library. The package can be used stand-alone or easily added to Laravel. 

## Install
```
$ composer require joshralph/password-policy
```

## Usage

### Policy Builder

```php
    $builder = new \PasswordPolicy\PolicyBuilder(new \PasswordPolicy\Policy);
    $builder->minLength(6)
        ->upperCase();
```

Any of the following methods may be chained on the builder class to build your password policy.

#### minLength(length)

##### length
Type: int

Minimum number of characters the password must contain.

#### maxLength(length)

##### length
Type: int

Maximum number of characters the password must contain.

#### upperCase([min])

##### min
Type: int

Minimum number of upper case characters the password must contain.

#### lowerCase([min])

##### min
Type: int

Minimum number of lower case characters the password must contain.

#### digits([min])

##### min
Type: int

Minimum number of numeric characters the password must contain.

#### doesNotContain(phrases [,phrases])

##### phrases
Type: string|array

Phrases that the password should not contain

*Example*

`php ->doesNotContain('password', $firstName, $lastName)`

