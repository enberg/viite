<?php

namespace Viite;

use InvalidArgumentException;

/**
 * @param mixed $input
 * @return bool
 */
function validate_input_length($input) {
    $length = strlen($input);
    
    return $length >= 3 && $length <= 19;
}

/**
 * @param mixed $input
 * @return bool
 */
function validate_input_integerish($input) {
    return is_int($input) || strval(intval($input)) === $input;
}

/**
 * @param mixed $input
 * @return bool
 */
function validate_input($input) {
    return validate_input_integerish($input) && validate_input_length($input);
}

/**
 * @param string|int $input
 * 
 * @throws InvalidArgumentException
 * 
 * @return int
 */
function calculate_check_digit($input) {
    if (!validate_input_integerish($input)) {
        throw new InvalidArgumentException("Check digits can only be calculated for integers.");
    }
    
    $parts = str_split($input);

    $weights = str_pad('', count($parts), '731');

    $weightedInput = array_map(
        function ($digit, $weight) {
            return (int) $digit * (int) $weight;
        },
        array_reverse($parts),
        str_split($weights)
    );

    $result = 10 - (array_sum($weightedInput) % 10);

    return $result % 10;
}

/**
 * @param string|int $input
 * 
 * @throws InvalidArgumentException
 * 
 * @return string
 */
function generate($input) {
    if (!validate_input_length($input)) {
        throw new InvalidArgumentException("Input must be between 3 and 19 characters to generate valid reference numbers.");
    }
    
    return $input . calculate_check_digit($input);
}

/**
 * @param string|int $referenceNumber
 * @return bool
 */
function check($referenceNumber) {
    $inputPart = substr($referenceNumber, 0, -1);
    return validate_input($inputPart) && strval($referenceNumber) === generate($inputPart);
}

/**
 * @param string|int $referenceNumber
 * @return string
 */
function format($referenceNumber) {
    $parts = str_split($referenceNumber, 5);

    return implode(' ', $parts);
}
