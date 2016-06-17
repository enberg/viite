# Viite [![Build Status](https://travis-ci.org/enberg/viite.svg?branch=master)](https://travis-ci.org/enberg/viite)

Viite is a single class library for generating and validating finnish reference numbers with check digits according to the [FFI specification](https://www.fkl.fi/en/material/publications/Publications/The_reference_number_and_the_check_digit.pdf).

### Install

Using [Composer](https://getcomposer.org/):
```sh
$ composer require enberg/viite
```

### Usage

Generate a reference number:
```php
$input = '123123';
$referenceNumber = Viite\generate($input);

echo $referenceNumber; // "1231234"

// Viite also contains a function for formatting reference numbers according to finnish conventions
echo Viite\format($referenceNumber); // Yields "12312 34"
```

Checking a reference number:
```php
if (Viite\check('1231234')) {
    echo 'Yay!';
}
```

License
----

MIT
