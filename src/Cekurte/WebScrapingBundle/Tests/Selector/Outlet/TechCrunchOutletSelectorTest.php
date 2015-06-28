<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\WebScrapingBundle\Tests\Selector\Outlet;

use Cekurte\WebScrapingBundle\Selector\Core\MetaSelector;
use Cekurte\WebScrapingBundle\Selector\Core\OutletSelectorInterface;
use Cekurte\WebScrapingBundle\Selector\Outlet\TechCrunchOutletSelector;
use Cekurte\WebScrapingBundle\Selector\SelectorBuilder;

class TechCrunchOutletSelectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var OutletSelectorInterface
     */
    private $outlet;

    public function setUp()
    {
        $this->outlet = new TechCrunchOutletSelector(
            new MetaSelector()
        );
    }

    public function testImplementsOutletSelectorInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\WebScrapingBundle\\Selector\\Outlet\\TechCrunchOutletSelector'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Cekurte\\WebScrapingBundle\\Selector\\Core\\OutletSelectorInterface'
        ));
    }

    public function testGetOutletName()
    {
        $name = $this->outlet->getName();

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorInterface',
            $name
        );

        $this->assertEquals('meta[property="og:site_name"]', $name->getSelectorKey());

        $this->assertEquals(SelectorBuilder::NODE_ATTR, $name->getSelectorType());

        $this->assertEquals('content', $name->getSelectorAttr());
    }

    public function testGetOutletDescription()
    {
        $name = $this->outlet->getDescription();

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorInterface',
            $name
        );

        $this->assertEquals('meta[property="og:description"]', $name->getSelectorKey());

        $this->assertEquals(SelectorBuilder::NODE_ATTR, $name->getSelectorType());

        $this->assertEquals('content', $name->getSelectorAttr());
    }
}
