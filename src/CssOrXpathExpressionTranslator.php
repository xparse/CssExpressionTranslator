<?

namespace Xparse\CssExpressionTranslator;

use Xparse\ExpressionTranslator\ExpressionTranslatorInterface;

/**
 * Automatically detect xpath or css query language and convert it to the xpath
 */
class CssOrXpathExpressionTranslator implements ExpressionTranslatorInterface
{

    /**
     * @var ExpressionTranslatorInterface
     */
    private static $translator;

    /**
     * @var ExpressionTranslatorInterface
     */
    private $cssTranslator;


    /**
     * @param ExpressionTranslatorInterface $cssTranslator
     */
    public function __construct(ExpressionTranslatorInterface $cssTranslator)
    {
        $this->cssTranslator = $cssTranslator;
    }


    public static function getTranslator(): ExpressionTranslatorInterface
    {
        if (self::$translator === null) {
            self::$translator = new CssOrXpathExpressionTranslator(new CssExpressionTranslator());
        }
        return self::$translator;
    }


    public function convertToXpath(string $expression): string
    {
        if (!is_string($expression)) {
            throw new \InvalidArgumentException('Expect expression to be the type of string. Given: ' . gettype($expression));
        }
        $expression = trim($expression);
        if (empty($expression)) {
            throw new \InvalidArgumentException('Expect not empty expression');
        }
        if ($expression === '.') {
            return $expression;
        }
        if (strpos($expression, './') === 0) {
            return $expression;
        }
        $firstChar = substr($expression, 0, 1);
        if (in_array($firstChar, ['/', '('])) {
            return $expression;
        }
        return $this->cssTranslator->convertToXpath($expression);
    }

}