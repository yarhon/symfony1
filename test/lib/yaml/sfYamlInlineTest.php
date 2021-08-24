<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../../../lib/yaml/sfYamlInline.class.php');

class sfYamlInlineTest extends TestCase
{
    /**
     * @dataProvider dumpProvider
     */
    public function testDump($value, $expected)
    {
        self::assertSame($expected, sfYamlInline::dump($value));
    }

    public function dumpProvider()
    {
        return [
            [null, 'null'],
            ['string', 'string'],
            [true, 'true'],
            [false, 'false'],
            [6, 6],
            ["asdf\nasdf", '"asdf\nasdf"'],
            ['', "''"],
            ['1234', "'1234'"],
            ['true', "'true'"],
            ['false', "'false'"],
            [['a', 'b'], '[a, b]'],
            [['a' => 'b'], '{ a: b }']
        ];
    }
}
