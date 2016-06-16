<?php
namespace Grav\Plugin;

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

  public function getFilters()
  {
    return [
      new \Twig_SimpleFilter('link_to', [$this, 'linkTo']),
    ];
  }

  public function getFunctions()
  {
    return [
      new \Twig_SimpleFunction('link_to', [$this, 'linkTo']),
    ];
  }

  public function linkTo($raw, $options = array())
  {
    switch(gettype($raw)) {
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

    if(isset($options['page'])) {
      $page_opts = array(
        'href' => $options['page']->link(),
        'content' => $options['page']->menu()
      );
      $options = array_merge($page_opts, $options);
    }

    $options['content'] = isset($options['content']) ? $options['content'] : '';
    
    $blacklist = array('page', 'content');


    foreach ($options as $key => $value) {
      if(!in_array($key, $blacklist)) {
        $options['attributes'][$key] = $value;
      }
    }

    return $this->formatLink($options);
  }

  private function formatLink($options) {

    return '<a' . $this->formatAttributes($options['attributes']) . '>' . $options['content'] . '</a>';
  }

  private function formatAttributes($attributes) {
    $attribute_string = '';
    foreach ($attributes as $key => $value) {
      $attribute_string .= ' ' . $key . '="' . $value . '"';
    }
    return $attribute_string;
  }
}
