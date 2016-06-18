<?php
namespace Grav\Plugin\LinkToTwigExtension;

/**
* LinkToTwigExtension adds a link_to filter and helper function to Twig.
*
* That class adds a filter and a function that helps to transform different
* type of data into links.
*
* Example usage:
* {{ pages.find('/home')|link_to }}
*
* @author   Patrick P. Henley <patrick.p.henley@gmail.com>
*/
class LinkToTwigExtension extends \Twig_Extension
{
    /**
    * Returns extension name.
    *
    * @return string
    */
    public function getName()
    {
        return 'LinkToTwigExtension';
    }

    /**
     * Returns a filter
     *
     * @return \Twig_SimpleFilter
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('link_to', [$this, 'linkTo']),
        ];
    }

    /**
     * Returns a filter
     *
     * @return \Twig_SimpleFunction
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('link_to', [$this, 'linkTo']),
        ];
    }

    /**
     * Takes a set of data and returns a formatted HTML tag link.
     *
     * @param string|object|array $rawElement The element that we want to link to.
     * @param array $config An optional set of config to be applied on the $rawElement.
     *
     * @return \LinkHelper
     */
    public function linkTo($rawElement, $config)
    {
        return new LinkHelper($rawElement, $config);
    }
}
