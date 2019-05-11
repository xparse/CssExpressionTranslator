<?php
declare(strict_types=1);

namespace Tests\Atl\Http\Parser;

use PHPUnit\Framework\TestCase;
use Xparse\CssExpressionTranslator\CssOrXpathExpressionTranslator;

/**
 * @author Ivan Shcherbak <alotofall@gmail.com>
 */
final class CssOrXpathExpressionTranslatorTest extends TestCase
{

    /**
     * @return array
     */
    public function getQueriesDataProvider(): array
    {
        return [
            [
                '.',
                '.',
            ],
            [
                '//a',
                '//a',
            ],
            [
                '/html',
                '/html',
            ],
            [
                './div',
                './div',
            ],
            [
                './/html',
                './/html',
            ],
            [
                '(//a)[1]',
                '(//a)[1]',
            ],
            [
                '(/body/a/@href)[last()]',
                '(/body/a/@href)[last()]',
            ],
            [
                'a',
                'descendant-or-self::a',
            ],
            [
                '   a',
                'descendant-or-self::a',
            ],
            [
                'a text()',
                'descendant-or-self::a/text()',
            ],
            [
                '       a text()        ',
                'descendant-or-self::a/text()',
            ],
            [
                'a @href',
                'descendant-or-self::a/@href',
            ],
            [
                'td a',
                'descendant-or-self::td/descendant-or-self::*/a',
            ],
            [
                'td > a',
                'descendant-or-self::td/a',
            ],
            [
                'td > a @href',
                'descendant-or-self::td/a/@href',
            ],
            [
                'b, i',
                'descendant-or-self::b | descendant-or-self::i',
            ],
            [
                'b.bold',
                "descendant-or-self::b[@class and contains(concat(' ', normalize-space(@class), ' '), ' bold ')]",
            ],
        ];
    }


    /**
     * @dataProvider getQueriesDataProvider
     */
    public function testQueries(string $input, string $expect): void
    {
        $output = CssOrXpathExpressionTranslator::getTranslator()
            ->convertToXpath($input);
        static::assertEquals($expect, $output);
    }


    /**
     * @expectedException \InvalidArgumentException
     */
    public function testEmptyString(): void
    {
        /** @noinspection UnusedFunctionResultInspection */
        CssOrXpathExpressionTranslator::getTranslator()->convertToXpath('');
    }


    /**
     * @expectedException \InvalidArgumentException
     */
    public function testEmptyStringWithSpaces(): void
    {
        /** @noinspection UnusedFunctionResultInspection */
        CssOrXpathExpressionTranslator::getTranslator()->convertToXpath('     ');
    }

}
