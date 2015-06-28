<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\WebScrapingBundle\Tests\Template\Core;

use Cekurte\WebScrapingBundle\Selector\Core\LinkSelector;
use Cekurte\WebScrapingBundle\Template\Core\LinkTemplate;
use Cekurte\WebScrapingBundle\Template\Core\LinkTemplateInterface;
use Symfony\Component\DomCrawler\Crawler;

class LinkTemplateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LinkTemplateInterface
     */
    private $link;

    public function setUp()
    {
        $body = <<<EOT
<html>
<head>
    <link href="fakeurl" rel="canonical" />
</head>
</html>
EOT;

        $this->link = new LinkTemplate(new Crawler($body), new LinkSelector());
    }

    public function testImplementsLinkTemplateInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\WebScrapingBundle\\Template\\Core\\LinkTemplate'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Cekurte\\WebScrapingBundle\\Template\\Core\\LinkTemplateInterface'
        ));
    }

    public function testGetCanonical()
    {
        $this->assertEquals('fakeurl', $this->link->getCanonical());
    }
}
