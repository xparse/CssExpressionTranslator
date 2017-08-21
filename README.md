# CssExpressionTranslator

[![Packagist](https://img.shields.io/packagist/v/xparse/css-expression-translator.svg?style=flat-square)](https://packagist.org/packages/xparse/css-expression-translator)
[![Travis](https://img.shields.io/travis/xparse/CssExpressionTranslator/master.svg?style=flat-square)](https://travis-ci.org/xparse/CssExpressionTranslator)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/xparse/css-expression-translator.svg?style=flat-square)](https://packagist.org/packages/xparse/css-expression-translator)

Translate css to xpath. Based on [symfony/css-selector](https://github.com/symfony/css-selector)


## Install

Via Composer

``` bash
composer require xparse/css-expression-translator
```

## Usage

``` php
$translator = new CssExpressionTranslator();
echo $translator->toXpath('a');
```

## Testing

``` bash
    ./vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](https://github.com/Xparse/CssExpressionTranslator/blob/master/CONTRIBUTING.md) for details.


## Credits

- [funivan](https://github.com/funivan)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
