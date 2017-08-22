<?php

  namespace Xparse\CssExpressionTranslator;

  use Symfony\Component\CssSelector\CssSelectorConverter;
  use Xparse\ExpressionTranslator\ExpressionTranslatorInterface;

  /**
   *
   * @package Xparse\CssExpressionTranslator
   */
  class CssExpressionTranslator extends CssSelectorConverter implements ExpressionTranslatorInterface {

    /**
     * @param string $cssExpression
     * @return string
     */
    public function convertToXpath($cssExpression) {
      $xpathExpression = [];
      foreach (explode(', ', $cssExpression) as $expression) {
        preg_match('!(.+) (@.+|.+\(\))$!', $expression, $matchExpression);
        if (!array_key_exists(2, $matchExpression)) {
          $xpathExpression[] = parent::toXPath($expression);
        } else {
          $xpathExpression[] = parent::toXPath($matchExpression[1]) . '/' . $matchExpression[2];
        }
      }
      return implode(' | ', $xpathExpression);
    }


  }
