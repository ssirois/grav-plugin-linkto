<?php

namespace Grav\Plugin;

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
     * @param string|object|array $raw The element that we want to link to.
     * @param array $options An optional set of options to configure the link.
     *
     * @return \Twig_SimpleFunction
     */
    public function linkTo($raw, $options = array())
    {
        switch (gettype($raw)) {
            case 'object':
                $raw = array('page' => $raw);
                break;
            case 'string':
                $raw = array('content' => $raw);
                break;
            case 'array':
                break;
            default:
                $raw = array();
        }

        $options = array_merge($raw, $options);

        if (isset($options['page'])) {
            $page_opts = array(
                'href' => $options['page']->link(),
                'content' => $options['page']->menu()
            );
            $options = array_merge($page_opts, $options);
        }

        $options['content'] = isset($options['content']) ? $options['content'] : '';

        $blacklist = array('page', 'content');


        foreach ($options as $key => $value) {
            if (!in_array($key, $blacklist)) {
                $options['attributes'][$key] = $value;
            }
        }

        return $this->formatLink($options['attributes'], $options['content']);
    }

    /**
     * Build an HTML link from HTML attributes and the content of the link.
     *
     * @param string $attributes A string that contains all the html attributes of the link.
     * @param string $content A string that contains the content of the link.
     *
     * @return string.
     */
    private function formatLink($attributes = '', $content = '')
    {

        return '<a' . $this->formatAttributes($attributes) . '>' . $content . '</a>';
    }

    /**
     * Format the HTML attribute string of the link using an array of attributes.
     *
     * @param array $attributes An array that contains all the html attributes of the link.
     *
     * @return string
     */
    private function formatAttributes($attributes)
    {
        $attribute_string = '';
        foreach ($attributes as $key => $value) {
            $attribute_string .= ' ' . $key . '="' . $value . '"';
        }
        return $attribute_string;
    }
}
