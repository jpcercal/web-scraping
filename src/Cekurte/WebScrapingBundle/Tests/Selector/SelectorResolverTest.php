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

use Cekurte\WebScrapingBundle\Selector\Core\MetaSelector;
use Cekurte\WebScrapingBundle\Selector\SelectorResolver;
use Symfony\Component\DomCrawler\Crawler;

class SelectorResolverTest extends \PHPUnit_Framework_TestCase
{
    public function testCreate()
    {
        $instance = SelectorResolver::create();

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorResolver',
            $instance
        );
    }

    public function testIsResolved()
    {
        $instance = SelectorResolver::create();

        $reflection = new \ReflectionClass($instance);

        $method = $reflection->getMethod('isResolved');

        $method->setAccessible(true);

        $this->assertFalse($method->invokeArgs($instance, array()));
    }

    public function testIsResolvedTrue()
    {
        $instance = SelectorResolver::create();

        $crawler = new Crawler('');

        $metaSelector = new MetaSelector();

        $instance->resolve($crawler, $metaSelector->getDescription());

        $reflection = new \ReflectionClass($instance);

        $method = $reflection->getMethod('isResolved');

        $method->setAccessible(true);

        $this->assertTrue($method->invokeArgs($instance, array()));

        $this->assertEmpty($instance->getSingleResult());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetSingleResult()
    {
        SelectorResolver::create()->getSingleResult();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetResult()
    {
        SelectorResolver::create()->getResult();
    }
}
