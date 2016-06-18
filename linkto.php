<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Plugin\LinkToTwigExtension;

class LinkToPlugin extends Plugin
{
    /**
     * @var LinkToPlugin
     */

    /**
     * Return a list of subscribed events.
     *
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
        if ($this->isAdmin()) {
            $this->active = false;
            return;
        }

        if ($this->config->get('plugins.linkto.enabled')) {
            $this->enable([
                'onTwigExtensions' => ['onTwigExtensions', 0]
            ]);
        }
    }

    /**
     * Add Twig Extensions
     */
    public function onTwigExtensions()
    {
        require_once(__DIR__.'/classes/LinkToTwigExtension.php');
        require_once(__DIR__.'/classes/LinkHelper.php');
        require_once(__DIR__.'/classes/AttributeHelper.php');
        require_once(__DIR__.'/classes/AttributeListHelper.php');

        $this->grav['twig']->twig->addExtension(new LinkToTwigExtension\LinkToTwigExtension());
    }
}
