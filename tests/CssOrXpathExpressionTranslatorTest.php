<?

  namespace Tests\Atl\Http\Parser;

  use PHPUnit\Framework\TestCase;
  use Xparse\CssExpressionTranslator\CssOrXpathExpressionTranslator;

  /**
   *
   */
  class CssOrXpathExpressionTranslatorTest extends TestCase {

    /**
     * @var CssOrXpathExpressionTranslator
     */
    private $converter;


    /**
     * @inheritDoc
     */
    protected function setUp() {
      parent::setUp();
      $this->converter = CssOrXpathExpressionTranslator::getTranslator();

    }


    /**
     * @return array
     */
    public function getQueriesDataProvider() {
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
          '       a text(), a @href, img @src',
          'descendant-or-self::a/text() | descendant-or-self::a/@href | descendant-or-self::img/@src',
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
     * @param string $input
     * @param string $expect
     */
    public function testQueries($input, $expect) {
      $output = $this->converter->convertToXpath($input);
      static::assertEquals($expect, $output);
    }


    /**
     * @expectedException \InvalidArgumentException
     */
    public function testEmptyString() {
      $this->converter->convertToXpath('');
    }


    /**
     * @expectedException \InvalidArgumentException
     */
    public function testEmptyStringWithSpaces() {
      $this->converter->convertToXpath('     ');
    }

  }
