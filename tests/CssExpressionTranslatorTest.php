<?php

  namespace Xparse\CssExpressionTranslator\Test;

  use PHPUnit\Framework\TestCase;

  /**
   * @author Ivan Shcherbak <dev@funivan.com> 02.12.15
   */
  class CssExpressionTranslatorTest extends TestCase {

    /**
     * @return array
     */
    public function getConvertWithAttributesDataProvider() {
      return [
        ['a', 'descendant-or-self::a'],
        ['a @a', 'descendant-or-self::a/@a'],
        ['a text()', 'descendant-or-self::a/text()'],
        ['a.foo @href', "descendant-or-self::a[@class and contains(concat(' ', normalize-space(@class), ' '), ' foo ')]/@href"],
        ['a.foo @href, b.bar @href', "descendant-or-self::a[@class and contains(concat(' ', normalize-space(@class), ' '), ' foo ')]/@href | descendant-or-self::b[@class and contains(concat(' ', normalize-space(@class), ' '), ' bar ')]/@href"]
      ];
    }


    /**
     * @param string $input
     * @param string $expect
     * @dataProvider getConvertWithAttributesDataProvider
     */
    public function testConvertWithAttributes($input, $expect) {
      $translator = new \Xparse\CssExpressionTranslator\CssExpressionTranslator();
      $result = $translator->convertToXpath($input);

      $this->assertEquals($expect, $result);
    }


  }