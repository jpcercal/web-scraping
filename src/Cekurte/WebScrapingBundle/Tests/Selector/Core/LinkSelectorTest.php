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

use Cekurte\WebScrapingBundle\Selector\Core\LinkSelector;
use Cekurte\WebScrapingBundle\Selector\Core\LinkSelectorInterface;
use Cekurte\WebScrapingBundle\Selector\SelectorBuilder;

class LinkSelectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LinkSelectorInterface
     */
    private $link;

    public function setUp()
    {
        $this->link = new LinkSelector();
    }

    public function testImplementsLinkSelectorInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\WebScrapingBundle\\Selector\\Core\\LinkSelector'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Cekurte\\WebScrapingBundle\\Selector\\Core\\LinkSelectorInterface'
        ));
    }

    public function testGetCanonical()
    {
        $canonical = $this->link->getCanonical();

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorInterface',
            $canonical
        );

        $this->assertEquals('link[rel="canonical"]', $canonical->getSelectorKey());

        $this->assertEquals(SelectorBuilder::NODE_ATTR, $canonical->getSelectorType());

        $this->assertEquals('href', $canonical->getSelectorAttr());
    }
}
