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
     * @param string $cssExpr
     * @return string
     */
    public function convertToXpath($cssExpr) {
      preg_match('!(.+) (@.+|.+\(\))$!', $cssExpr, $data);
      if (empty($data[2])) {
        return parent::toXPath($cssExpr);
      }

      return parent::toXPath($data[1]) . '/' . $data[2];
    }


  }
