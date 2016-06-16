<?php

namespace Viite;

use function Assert\that as assert;

function calculate_check_digit($input) {
    assert($input)
        ->integerish('Can only calculate check-digit for numeric strings.');
    
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

function check_reference_number($referenceNumber) {
    return (int) substr($referenceNumber, -1) ===
        calculate_check_digit(substr($referenceNumber, 0, -1));
}

function format_reference_number($referenceNumber) {
    $parts = str_split($referenceNumber, 5);

    return implode(' ', $parts);
}
