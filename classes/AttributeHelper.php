<?php
namespace Grav\Plugin\LinkToTwigExtension;

/**
* AttributeHelper format an attribute string.
*
* @author   Patrick P. Henley <patrick.p.henley@gmail.com>
*/
class AttributeHelper
{
    /**
    * @var string The name of the attributes.
    */
    private $name;

    /**
    * @var string The value of the attributes.
    */
    private $value;

    /**
     * Instantiate a new AttributeHelper with a name and a value.
     *
     * @param string $name The name to be given to the AttributeHelper.
     * @param string $value The value to be given to the AttributeHelper.
     */
    public function __construct($name = '', $value = '')
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Returns the formatted attribute.
     *
     * @return string
     */
    public function __toString()
    {
        return (!empty($this->value)) ? sprintf('%s="%s"', $this->name, $this->value) : $this->name;
    }
}
