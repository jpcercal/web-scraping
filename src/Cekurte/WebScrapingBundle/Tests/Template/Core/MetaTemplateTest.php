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

use Cekurte\WebScrapingBundle\Selector\Core\MetaSelector;
use Cekurte\WebScrapingBundle\Template\Core\MetaTemplate;
use Cekurte\WebScrapingBundle\Template\Core\MetaTemplateInterface;
use Symfony\Component\DomCrawler\Crawler;

class MetaTemplateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MetaTemplateInterface
     */
    private $meta;

    public function setUp()
    {
        $body = <<<EOT
<html>
<head>
    <meta name="description" content="description" />
    <meta name="keywords" content="val1,val2,val3" />
    <meta name="charset" content="utf-8" />
    <meta property="og:site_name" content="og_site_name" />
    <meta property="og:title" content="og_title" />
    <meta property="og:description" content="og_description" />
    <meta property="og:image" content="og_image" />
    <meta property="og:url" content="og_url" />
</head>
</html>
EOT;

        $this->meta = new MetaTemplate(new Crawler($body), new MetaSelector());
    }

    public function testImplementsMetaTemplateInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\WebScrapingBundle\\Template\\Core\\MetaTemplate'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Cekurte\\WebScrapingBundle\\Template\\Core\\MetaTemplateInterface'
        ));
    }

    public function testGetDescription()
    {
        $this->assertEquals('description', $this->meta->getDescription());
    }

    public function testGetKeywords()
    {
        $this->assertEquals(array('val1', 'val2', 'val3'), $this->meta->getKeywords());
    }

    public function testGetCharset()
    {
        $this->assertEquals('utf-8', $this->meta->getCharset());
    }

    public function testGetOgSiteName()
    {
        $this->assertEquals('og_site_name', $this->meta->getOgSiteName());
    }

    public function testGetOgTitle()
    {
        $this->assertEquals('og_title', $this->meta->getOgTitle());
    }

    public function testGetOgDescription()
    {
        $this->assertEquals('og_description', $this->meta->getOgDescription());
    }

    public function testGetOgImage()
    {
        $this->assertEquals('og_image', $this->meta->getOgImage());
    }

    public function testGetOgUrl()
    {
        $this->assertEquals('og_url', $this->meta->getOgUrl());
    }
}
