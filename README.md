# Introduction

The alphabet validator is a validator that will validate given messages against
a configured [alphabet](https://github.com/HylianShield/alphabet).

# Installation

```shell
composer require hylianshield/validator-alphabet:^1.0
```

# Usage

The alphabet validator accepts an alphabet instance.
It is based on the [PCRE validator](https://github.com/HylianShield/validator-pcre).

```php
<?php
use \HylianShield\Alphabet\Alphabet;
use \HylianShield\Validator\Alphabet\AlphabetValidator;

$alphabet  = new Alphabet('A', 'B', 'C');
$validator = new AlphabetValidator($alphabet);

echo $validator->getIdentifier();
```

Outputs:

```
pcre(/^[ABC]*$/)
```

# Testing

To run the unit tests, to check the code, simply run one of the pre-configured
composer scripts:

- `composer test` Runs PHPUnit
- `composer coverage` Runs PHPUnit with text coverage
- `composer coverage-html` Runs PHPUnit with HTML coverage and opens the
  result in the browser.
