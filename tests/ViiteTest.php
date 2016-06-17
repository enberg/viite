<?php

use function Viite\generate;
use function Viite\format;
use function Viite\check;

class ViiteTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider badInputGenerator
     */
    public function itRejectsInvalidInput($input)
    {
        $this->setExpectedException(InvalidArgumentException::class);

        generate($input);
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
    public function itGroupsDigitsForPrint()
    {
        $viite = '1231234';

        $this->assertEquals(
            '12312 34',
            format($viite)
        );
    }

    /**
     * @test
     */
    public function itValidatesReferences()
    {
        $this->assertTrue(check('1232'));
    }
}
