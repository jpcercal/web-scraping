<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\WebScrapingBundle\Tests\Selector\Core;

use Cekurte\WebScrapingBundle\Selector\Core\MetaSelector;
use Cekurte\WebScrapingBundle\Selector\Core\MetaSelectorInterface;
use Cekurte\WebScrapingBundle\Selector\SelectorBuilder;

class MetaSelectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MetaSelectorInterface
     */
    private $meta;

    public function setUp()
    {
        $this->meta = new MetaSelector();
    }

    public function testImplementsMetaSelectorInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\WebScrapingBundle\\Selector\\Core\\MetaSelector'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Cekurte\\WebScrapingBundle\\Selector\\Core\\MetaSelectorInterface'
        ));
    }

    public function testGetMeta()
    {
        $meta = $this->meta->getMeta('fake');

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorInterface',
            $meta
        );

        $this->assertEquals('meta[name="fake"]', $meta->getSelectorKey());

        $this->assertEquals(SelectorBuilder::NODE_ATTR, $meta->getSelectorType());

        $this->assertEquals('content', $meta->getSelectorAttr());
    }

    public function testGetOgMeta()
    {
        $meta = $this->meta->getOgMeta('fake');

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorInterface',
            $meta
        );

        $this->assertEquals('meta[property="og:fake"]', $meta->getSelectorKey());

        $this->assertEquals(SelectorBuilder::NODE_ATTR, $meta->getSelectorType());

        $this->assertEquals('content', $meta->getSelectorAttr());
    }

    public function testGetCustomMeta()
    {
        $meta = $this->meta->getCustomMeta('fake="fakeselector"', 'fakeattr');

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorInterface',
            $meta
        );

        $this->assertEquals('meta[fake="fakeselector"]', $meta->getSelectorKey());

        $this->assertEquals(SelectorBuilder::NODE_ATTR, $meta->getSelectorType());

        $this->assertEquals('fakeattr', $meta->getSelectorAttr());
    }

    public function testGetDescription()
    {
        $meta = $this->meta->getDescription();

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorInterface',
            $meta
        );

        $this->assertEquals('meta[name="description"]', $meta->getSelectorKey());

        $this->assertEquals(SelectorBuilder::NODE_ATTR, $meta->getSelectorType());

        $this->assertEquals('content', $meta->getSelectorAttr());
    }

    public function testGetKeywords()
    {
        $meta = $this->meta->getKeywords();

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorInterface',
            $meta
        );

        $this->assertEquals('meta[name="keywords"]', $meta->getSelectorKey());

        $this->assertEquals(SelectorBuilder::NODE_ATTR, $meta->getSelectorType());

        $this->assertEquals('content', $meta->getSelectorAttr());
    }

    public function testGetCharset()
    {
        $meta = $this->meta->getCharset();

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorInterface',
            $meta
        );

        $this->assertEquals('meta[name="charset"]', $meta->getSelectorKey());

        $this->assertEquals(SelectorBuilder::NODE_ATTR, $meta->getSelectorType());

        $this->assertEquals('content', $meta->getSelectorAttr());
    }

    public function testGetOgSiteName()
    {
        $meta = $this->meta->getOgSiteName();

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorInterface',
            $meta
        );

        $this->assertEquals('meta[property="og:site_name"]', $meta->getSelectorKey());

        $this->assertEquals(SelectorBuilder::NODE_ATTR, $meta->getSelectorType());

        $this->assertEquals('content', $meta->getSelectorAttr());
    }

    public function testGetOgTitle()
    {
        $meta = $this->meta->getOgTitle();

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorInterface',
            $meta
        );

        $this->assertEquals('meta[property="og:title"]', $meta->getSelectorKey());

        $this->assertEquals(SelectorBuilder::NODE_ATTR, $meta->getSelectorType());

        $this->assertEquals('content', $meta->getSelectorAttr());
    }

    public function testGetOgDescription()
    {
        $meta = $this->meta->getOgDescription();

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorInterface',
            $meta
        );

        $this->assertEquals('meta[property="og:description"]', $meta->getSelectorKey());

        $this->assertEquals(SelectorBuilder::NODE_ATTR, $meta->getSelectorType());

        $this->assertEquals('content', $meta->getSelectorAttr());
    }

    public function testGetOgImage()
    {
        $meta = $this->meta->getOgImage();

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorInterface',
            $meta
        );

        $this->assertEquals('meta[property="og:image"]', $meta->getSelectorKey());

        $this->assertEquals(SelectorBuilder::NODE_ATTR, $meta->getSelectorType());

        $this->assertEquals('content', $meta->getSelectorAttr());
    }

    public function testGetOgUrl()
    {
        $meta = $this->meta->getOgUrl();

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorInterface',
            $meta
        );

        $this->assertEquals('meta[property="og:url"]', $meta->getSelectorKey());

        $this->assertEquals(SelectorBuilder::NODE_ATTR, $meta->getSelectorType());

        $this->assertEquals('content', $meta->getSelectorAttr());
    }
}
