<?php
namespace Grav\Plugin\LinkToTwigExtension;

/**
* AttributeListHelper takes an associative array of attributes and output a string.
*
* @author   Patrick P. Henley <patrick.p.henley@gmail.com>
*/
class AttributeListHelper
{
    /**
    * @var array of formatted attributes.
    */
    private $attributes;

    /**
     * Instantiate a new AttributeListHelper
     *
     * Takes a list of unformatted attributes, format it and instantiate
     * a new AttributeListHelper with it.
     *
     * @param array $attributes unformatted attributes associative array.
     */
    public function __construct($attributes = array())
    {
        $this->attributes = $this->formatAttributes($attributes);
    }

    /**
     * Return a list of formatted attributes.
     *
     * @param array $attributes attributes to be formatted.
     *
     * @return string
     */
    private function formatAttributes($attributes)
    {
        array_walk(
            $attributes,
            function (&$value, $name) {
                $value = new AttributeHelper($name, $value);
            }
        );

        return $attributes;
    }

    /**
     * Returns the formatted attribute list.
     *
     * @return string
     */
    public function __toString()
    {
        return implode(' ', $this->attributes);
    }
}
