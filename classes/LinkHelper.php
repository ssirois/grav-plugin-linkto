<?php
namespace Grav\Plugin\LinkToTwigExtension;

/**
* LinkHelper takes some configs and output an HTML link that.
*
* @author   Patrick P. Henley <patrick.p.henley@gmail.com>
*/
class LinkHelper
{
    /**
     * @var array configures the HTML link tag
     */
    private $config;

    /**
     * Instantiate a new LinkHelper.
     *
     * @param string|object|array $rawElement The element that we want to link to.
     * @param array $wantedConfig An optional set of config to be applied on the $rawElement.
     */
    public function __construct($rawElement, $wantedConfig = [])
    {
        $initialConfig = $this->processRawElement($rawElement);
        $pageObjectConfig = $this->getPageObjectConfigs($initialConfig, $wantedConfig);
        $this->config = array_merge($pageObjectConfig, $initialConfig, $wantedConfig);
    }

    /**
     * Somekind of factory function that takes a $rawElement and outputs a $config array.
     *
     * @param string|object|array $rawElement The element that we want to link to.
     * @param array $wantedConfig An optional set of config to be applied on the $rawElement.
     *
     * @return array
     */
    private function processRawElement($rawElement)
    {
        switch (gettype($rawElement)) {
            case 'object':
                return ['page' => $rawElement];
            case 'string':
                return ['content' => $rawElement];
            case 'array':
                return $rawElement;
            default:
                return [];
        }
    }

    /**
     * Find a page object and convert it into a config array;
     *
     * @param array $initialCongfig the config of the object that we want to link to.
     * @param array $mainConfig the config that we want to apply on the link.
     *
     * @return array
     */
    private function getPageObjectConfigs($initialConfig, $mainConfig)
    {
        if (isset($mainConfig['page'])) {
            $pageObject = $mainConfig['page'];
        } elseif (isset($initialConfig['page'])) {
            $pageObject = $initialConfig['page'];
        } else {
            return [];
        }

        return [
            'href' => $pageObject->link(),
            'content' => $pageObject->menu()
        ];
    }

    /**
     * Returns a string that contains the HTML content of the link.
     *
     * @return string
     */
    private function getContent()
    {
        return isset($this->config['content']) ? $this->config['content'] : '';
    }

    /**
     * Returns a string that contains all the attributes of the link.
     *
     * @return string
     */
    private function getAttributes()
    {
        $attributes = $this->getAttributesOutOfConfigs();

        return new AttributeListHelper($attributes);
    }

    /**
     * Returns an array of "real" attributes out of all configs
     *
     * @return array
     */
    private function getAttributesOutOfConfigs() {
        $falseAttributes = array('page', 'content');
        $attributes = array();
        foreach(array_keys($this->config) as $key) {
          if (!in_array($key, $falseAttributes)) {
            $attributes[$key] = $this->config[$key];
          }
        }

        return $attributes;
    }

    /**
     * Returns the formatted link.
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf('<a %s>%s</a>', $this->getAttributes(), $this->getContent());
    }
}
