<?php
/**
 * Created by PhpStorm.
 * User: behzodqurbonov
 * Date: 19.11.16
 * Time: 23:54
 */

class TestEventsModule extends Unittest_TestCase {

    function providerStrLen()
    {
        return array(
            array('One set of testcase data', 24),
            array('This is a different one', 23),
        );
    }

    /**
     * @dataProvider providerStrLen
     */
    function testStrLen($string, $length)
    {
        $this->assertSame(
            $length,
            strlen($string)
        );
    }
}