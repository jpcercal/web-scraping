<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\WebScrapingBundle\Tests\Selector;

use Cekurte\WebScrapingBundle\Selector\SelectorBuilder;

class SelectorBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testImplementsSelectorInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorBuilder'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorInterface'
        ));
    }

    public function testConstNodeAttrIsDefined()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorBuilder'
        );

        $this->assertTrue($reflection->hasConstant('NODE_ATTR'));
    }

    public function testConstNodeTextIsDefined()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorBuilder'
        );

        $this->assertTrue($reflection->hasConstant('NODE_TEXT'));
    }

    public function testConstNodeHtmlIsDefined()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorBuilder'
        );

        $this->assertTrue($reflection->hasConstant('NODE_HTML'));
    }

    public function testCreate()
    {
        $instance = SelectorBuilder::create();

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorBuilder',
            $instance
        );
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetSelectorKeyException()
    {
        SelectorBuilder::create()->setSelectorKey('');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetSelectorKeyCouldBeAString()
    {
        SelectorBuilder::create()->setSelectorAttr(null);
    }

    public function testSetSelectorKey()
    {
        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorBuilder',
            SelectorBuilder::create()->setSelectorKey('div#fakeid')
        );
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetSelectorTypeException()
    {
        SelectorBuilder::create()->setSelectorType('');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetSelectorTypeNotExistException()
    {
        SelectorBuilder::create()->setSelectorType('FAKE');
    }

    public function testSetSelectorType()
    {
        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorBuilder',
            SelectorBuilder::create()->setSelectorKey(SelectorBuilder::NODE_HTML)
        );
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetSelectorAttrNotEmptyToTypeNodeAttrException()
    {
        SelectorBuilder::create()
            ->setSelectorType(SelectorBuilder::NODE_ATTR)
            ->setSelectorAttr('')
        ;
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetSelectorAttrNotEmptyToTypeNodeUnknownException()
    {
        SelectorBuilder::create()->setSelectorType('FAKE');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetSelectorAttrCouldBeAString()
    {
        SelectorBuilder::create()->setSelectorAttr(null);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetSelectorAttrWithoutType()
    {
        SelectorBuilder::create()->setSelectorAttr('');
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetSelectorEmpty()
    {
        SelectorBuilder::create()->setSelectorAttr('');
    }

    public function testSetSelectorAttr()
    {
        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorBuilder',
            SelectorBuilder::create()->setSelectorType(SelectorBuilder::NODE_ATTR)->setSelectorAttr('fakeproperty')
        );
    }

    public function testGetSelectorTypes()
    {
        $this->assertEquals(3, count(SelectorBuilder::create()->getSelectorTypes()));
    }

    public function getSelectorKey()
    {
        $selector = SelectorBuilder::create()
            ->setSelectorKey('div#fakeid')
        ;

        $this->assertEquals(SelectorBuilder::NODE_HTML, $selector->getSelectorType());
    }

    public function getSelectorType()
    {
        $selector = SelectorBuilder::create()
            ->setSelectorType(SelectorBuilder::NODE_HTML)
        ;

        $this->assertEquals(SelectorBuilder::NODE_HTML, $selector->getSelectorType());
    }

    public function getSelectorAttr()
    {
        $selector = SelectorBuilder::create()
            ->setSelectorType(SelectorBuilder::NODE_ATTR)
            ->setSelectorAttr('fakeproperty')
        ;

        $this->assertEquals(SelectorBuilder::NODE_ATTR, $selector->getSelectorType());

        $this->assertEquals('fakeproperty', $selector->getSelectorAttr());
    }
}
