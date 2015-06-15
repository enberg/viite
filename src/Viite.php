<?php

namespace Viite;

class Viite
{
    /**
     * @var array
     */
    private $input;

    /**
     * @param string $input
     */
    public function __construct($input)
    {
        if (strlen($input) < 3 || strlen($input) > 19) {
            throw new InvalidArgumentException(
                'To generate a valid finnish referencenumber the input needs '
                . 'to be between 3 and 19 digits'
            );
        }

        $this->input = str_split($input);
    }

    /**
     * @return string
     */
    public function getInput()
    {
        return implode('', $this->input);
    }

    /**
     * @return integer
     */
    public function getCheckDigit()
    {
        $weights = str_pad('', count($this->input), '731');

        $weightedInput = array_map(
            function ($digit, $weight) {
                return (int) $digit * (int) $weight;
            },
            array_reverse($this->input),
            str_split($weights)
        );

        $result = 10 - (array_sum($weightedInput) % 10);

        return $result % 10;
    }

    /**
     * @return string
     */
    public function generate()
    {
        return $this->getInput() . $this->getCheckDigit();
    }

    /**
     * @return string
     */
    public function printFormated()
    {
        $parts = str_split($this->generate(), 5);

        return implode(' ', $parts);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->printFormated();
    }

    /**
     * @param string $referenceNumber
     *
     * @return boolean
     */
    public static function validate($referenceNumber)
    {
        $reference = new self(substr($referenceNumber, 0, -1));

        return (int) substr($referenceNumber, -1) === $reference->getCheckDigit();
    }
}
