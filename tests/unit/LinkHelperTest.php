<?php

use Grav\Plugin\LinkToTwigExtension\LinkHelper;
use \Codeception\Util\Stub;

class LinkHelperTest extends \Codeception\Test\Unit
{

    public function testLinkCreationFromPageObject()
    {
      $page = Stub::make('Grav\Common\Page\Page', ['link' => 'http://www.example.com/',  'menu' => 'Example.com']);
      $this->assertEquals('<a href="http://www.example.com/">Example.com</a>', new LinkHelper($page));
    }
}
