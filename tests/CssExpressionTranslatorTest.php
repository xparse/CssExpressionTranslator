<?php
declare(strict_types=1);

namespace Xparse\CssExpressionTranslator\Test;

use PHPUnit\Framework\TestCase;
use Xparse\CssExpressionTranslator\CssExpressionTranslator;

/**
 * @author Ivan Shcherbak <alotofall@gmail.com>
 */
class CssExpressionTranslatorTest extends TestCase
{

    /**
     * @return string[][]
     */
    final public function getConvertWithAttributesDataProvider(): array
    {
        return [
            ['a', 'descendant-or-self::a'],
            ['a @a', 'descendant-or-self::a/@a'],
            ['a text()', 'descendant-or-self::a/text()'],
            ['a.foo @href', "descendant-or-self::a[@class and contains(concat(' ', normalize-space(@class), ' '), ' foo ')]/@href"],
            ['a.foo @href, b.bar @href', "descendant-or-self::a[@class and contains(concat(' ', normalize-space(@class), ' '), ' foo ')]/@href | descendant-or-self::b[@class and contains(concat(' ', normalize-space(@class), ' '), ' bar ')]/@href"]
        ];
    }


    /**
     * @dataProvider getConvertWithAttributesDataProvider
     */
    final public function testConvertWithAttributes(string $input, string $expect): void
    {
        self::assertSame(
            $expect,
            (new CssExpressionTranslator())->convertToXpath($input)
        );
    }

}