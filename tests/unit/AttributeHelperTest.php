<?php

use Grav\Plugin\LinkToTwigExtension\AttributeHelper;

class AttributeHelperTest extends \Codeception\Test\Unit
{
    public function testThatNameAndValueAreOutputedInKeyValuePairFormat()
    {
        $name = 'class';
        $value = 'value';
        $expected = $name . '="' . $value . '"';

        $this->assertEquals($expected, new AttributeHelper($name, $value));
    }
}
