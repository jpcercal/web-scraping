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

use Cekurte\WebScrapingBundle\Selector\Core\ArticleSelectorInterface;
use Cekurte\WebScrapingBundle\Selector\Core\LinkSelector;
use Cekurte\WebScrapingBundle\Selector\Core\MetaSelector;
use Cekurte\WebScrapingBundle\Selector\Outlet\TechCrunchArticleSelector;
use Cekurte\WebScrapingBundle\Selector\Outlet\TechCrunchAuthorSelector;
use Cekurte\WebScrapingBundle\Selector\SelectorBuilder;

class TechCrunchArticleSelectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ArticleSelectorInterface
     */
    private $article;

    public function setUp()
    {
        $this->article = new TechCrunchArticleSelector(
            new TechCrunchAuthorSelector(),
            new MetaSelector(),
            new LinkSelector()
        );
    }

    public function testImplementsArticleSelectorInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\WebScrapingBundle\\Selector\\Outlet\\TechCrunchArticleSelector'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Cekurte\\WebScrapingBundle\\Selector\\Core\\ArticleSelectorInterface'
        ));
    }

    public function testGetTitle()
    {
        $title = $this->article->getTitle();

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorInterface',
            $title
        );

        $this->assertEquals('article .article-header h1.tweet-title', $title->getSelectorKey());

        $this->assertEquals(SelectorBuilder::NODE_TEXT, $title->getSelectorType());
    }

    public function testGetImage()
    {
        $content = $this->article->getImage();

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorInterface',
            $content
        );

        $this->assertEquals('meta[property="og:image"]', $content->getSelectorKey());

        $this->assertEquals(SelectorBuilder::NODE_ATTR, $content->getSelectorType());

        $this->assertEquals('content', $content->getSelectorAttr());
    }

    public function testGetUrl()
    {
        $content = $this->article->getUrl();

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorInterface',
            $content
        );

        $this->assertEquals('link[rel="canonical"]', $content->getSelectorKey());

        $this->assertEquals(SelectorBuilder::NODE_ATTR, $content->getSelectorType());

        $this->assertEquals('href', $content->getSelectorAttr());
    }

    public function testGetAbstract()
    {
        $content = $this->article->getAbstract();

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorInterface',
            $content
        );

        $this->assertEquals('article .article-entry p', $content->getSelectorKey());

        $this->assertEquals(SelectorBuilder::NODE_HTML, $content->getSelectorType());
    }

    public function testGetContent()
    {
        $content = $this->article->getContent();

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorInterface',
            $content
        );

        $this->assertEquals('article .article-entry', $content->getSelectorKey());

        $this->assertEquals(SelectorBuilder::NODE_HTML, $content->getSelectorType());
    }

    public function testGetPublicationDate()
    {
        $publicationDate = $this->article->getPublicationDate();

        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\SelectorInterface',
            $publicationDate
        );

        $this->assertEquals('article .article-header .byline time.timestamp', $publicationDate->getSelectorKey());

        $this->assertEquals(SelectorBuilder::NODE_ATTR, $publicationDate->getSelectorType());

        $this->assertEquals('datetime', $publicationDate->getSelectorAttr());
    }

    public function testGetAuthor()
    {
        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\Core\\AuthorSelectorInterface',
            $this->article->getAuthor()
        );
    }

    public function testGetMeta()
    {
        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\Core\\MetaSelectorInterface',
            $this->article->getMeta()
        );
    }

    public function testGetLink()
    {
        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Selector\\Core\\LinkSelectorInterface',
            $this->article->getLink()
        );
    }
}
