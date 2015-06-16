<?php

use Viite\Viite;

class ViiteTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider badInputGenerator
     */
    public function itRejectsInvalidInput($input)
    {
        $this->setExpectedException('InvalidArgumentException');

        $ref = new Viite($input);
    }

    /**
     * @return array
     */
    public function badInputGenerator()
    {
        return array(
            array(str_repeat('1', 2)),
            array(str_repeat('1', 20)),
            array('123456A'),
        );
    }

    /**
     * @test
     */
    public function itGroupsDigitForPrint()
    {
        $viite = new Viite('123123');

        $this->assertEquals(
            '12312 34',
            $viite->printFormatted()
        );
    }

    /**
     * @test
     */
    public function itValidatesPrettyPrintedReferences()
    {
        $this->assertTrue(Viite::validate('12312 34'));
    }
}
