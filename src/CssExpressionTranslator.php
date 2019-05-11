<?php

  namespace Xparse\CssExpressionTranslator;

  use Symfony\Component\CssSelector\CssSelectorConverter;
  use Xparse\ExpressionTranslator\ExpressionTranslatorInterface;

  class CssExpressionTranslator extends CssSelectorConverter implements ExpressionTranslatorInterface {

    public function convertToXpath(string $expression) : string {
      $xpathExpression = [];
      foreach (explode(', ', $expression) as $part) {
        preg_match('!(.+) (@.+|.+\(\))$!', $part, $matchExpression);
        if (!array_key_exists(2, $matchExpression)) {
          $xpathExpression[] = parent::toXPath($part);
        } else {
          $xpathExpression[] = parent::toXPath($matchExpression[1]) . '/' . $matchExpression[2];
        }
      }
      return implode(' | ', $xpathExpression);
    }


  }
