# Viite

Viite is a single class library for generating and validating finnish reference numbers with check digits according to the [FFI specification](https://www.fkl.fi/en/material/publications/Publications/The_reference_number_and_the_check_digit.pdf).

### Usage

Generate a reference number:
```php
$referenceNumber = new Viite\Viite(123123);

$referenceNumber->generate(); // Yields "1231234"

// Viite also graciously converts itself to a string with correct spacing
echo $referenceNumber; // Yields "12312 34"
```

Checking a reference number:
```php
if (Viite\Viite::validate('1231234')) {
    echo 'Yay!';
}
```

License
----

MIT
