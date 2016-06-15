<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;

class LinkToPlugin extends Plugin
{
    /**
     * @var LinkToPlugin
     */
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0],
        ];
    }
    /**
     * Initialize configuration
     */
    public function onPluginsInitialized()
    {
        $this->enable([
            'onTwigExtensions' => ['onTwigExtensions', 0]
        ]);
    }
    /**
     * Add Twig Extensions
     */
    public function onTwigExtensions()
    {
        require_once(__DIR__.'/twig/LinkToTwigExtension.php');
        $this->grav['twig']->twig->addExtension(new LinkToTwigExtension());
    }
}
