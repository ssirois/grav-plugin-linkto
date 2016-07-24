<?php
use Grav\Plugin\LinkToTwigExtension\LinkHelper;
use Grav\Plugin\LinkToTwigExtension\AttributeHelper;

class AttributeHelperTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testThatNameAndValueAreOutputedInKeyValuePairFormat()
    {
      $name = 'class';
      $value = 'value';
      $expected = $name . '="' . $value . '"';

      $this->assertEquals($expected, new AttributeHelper($name, $value));
    }
}
