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

use Cekurte\WebScrapingBundle\Selector\Core\AuthorSelectorInterface;
use Cekurte\WebScrapingBundle\Selector\Outlet\TechCrunchAuthorSelector;
use Cekurte\WebScrapingBundle\Selector\SelectorBuilder;

class TechCrunchAuthorSelectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AuthorSelectorInterface
     */
    private $author;

    public function setUp()
    {
        $this->author = new TechCrunchAuthorSelector();
    }

    public function testImplementsAuthorSelectorInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\WebScrapingBundle\\Selector\\Outlet\\TechCrunchAuthorSelector'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Cekurte\\WebScrapingBundle\\Selector\\Core\\AuthorSelectorInterface'
        ));
    }

    public function testGetName()
    {
        $name = $this->author->getName();

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorInterface',
            $name
        );

        $this->assertEquals('article .article-header a[rel="author"]', $name->getSelectorKey());

        $this->assertEquals(SelectorBuilder::NODE_TEXT, $name->getSelectorType());
    }

    public function testGetImage()
    {
        $this->assertNull($this->author->getImage());
    }

    public function testGetBiography()
    {
        $this->assertNull($this->author->getBiography());
    }

    public function testGetProfileUrl()
    {
        $profile = $this->author->getProfileUrl();

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorInterface',
            $profile
        );

        $this->assertEquals('article .article-header a[rel="author"]', $profile->getSelectorKey());

        $this->assertEquals(SelectorBuilder::NODE_ATTR, $profile->getSelectorType());

        $this->assertEquals('href', $profile->getSelectorAttr());
    }

    public function testGetFacebook()
    {
        $this->assertNull($this->author->getFacebook());
    }

    public function testGetTwitter()
    {
        $twitter = $this->author->getTwitter();

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorInterface',
            $twitter
        );

        $this->assertEquals('article .article-header .twitter-handle a', $twitter->getSelectorKey());

        $this->assertEquals(SelectorBuilder::NODE_TEXT, $twitter->getSelectorType());
    }
}
