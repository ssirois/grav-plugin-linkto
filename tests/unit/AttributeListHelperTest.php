<?php

use Grav\Plugin\LinkToTwigExtension\AttributeListHelper;

class AttributeListHelperTest extends \Codeception\Test\Unit
{

    public function testThatAttributesListAreFormattedProperly()
    {
        $attributes = [
            'class' => 'value',
            'style' => 'position: absolute',
            'data-test' => 'data'
        ];

        $expected = 'class="value" style="position: absolute" data-test="data"';
        $this->assertEquals($expected, new AttributeListHelper($attributes));
    }
}
