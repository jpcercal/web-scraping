<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\WebScrapingBundle\Tests\Template\Outlet;

use Cekurte\WebScrapingBundle\Selector\Core\MetaSelector;
use Cekurte\WebScrapingBundle\Selector\Outlet\TechCrunchOutletSelector;
use Cekurte\WebScrapingBundle\Template\Core\OutletTemplateInterface;
use Cekurte\WebScrapingBundle\Template\Outlet\TechCrunchOutletTemplate;
use Symfony\Component\DomCrawler\Crawler;

class TechCrunchOutletTemplateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var OutletTemplateInterface
     */
    private $outlet;

    public function setUp()
    {
        $body = <<<EOT
<html>
<head>
    <meta property="og:site_name" content="og_site_name" />
    <meta property="og:description" content="og_description" />
</head>
</html>
EOT;

        $this->outlet = new TechCrunchOutletTemplate(
            new Crawler($body),
            new TechCrunchOutletSelector(new MetaSelector())
        );
    }

    public function testImplementsOutletTemplateInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\WebScrapingBundle\\Template\\Outlet\\TechCrunchOutletTemplate'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Cekurte\\WebScrapingBundle\\Template\\Core\\OutletTemplateInterface'
        ));
    }

    public function testGetName()
    {
        $this->assertEquals('og_site_name', $this->outlet->getName());
    }

    public function testGetDescription()
    {
        $this->assertEquals('og_description', $this->outlet->getDescription());
    }
}
