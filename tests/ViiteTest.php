<?php

use function Viite\calculate_check_digit;
use function Viite\format_reference_number;
use function Viite\check_reference_number;

class ViiteTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider badInputGenerator
     */
    public function itRejectsInvalidInput($input)
    {
        $this->setExpectedException(Assert\AssertionFailedException::class);

        calculate_check_digit($input);
    }

    /**
     * @return array
     */
    public function badInputGenerator()
    {
        return [
            ['a parrot'],
            ['123456A'],
            [2.323],
        ];
    }

    /**
     * @test
     */
    public function itGroupsDigitForPrint()
    {
        $viite = '1231234';

        $this->assertEquals(
            '12312 34',
            format_reference_number($viite)
        );
    }

    /**
     * @test
     */
    public function itValidatesReferences()
    {
        $this->assertTrue(check_reference_number('1232'));
    }
}
