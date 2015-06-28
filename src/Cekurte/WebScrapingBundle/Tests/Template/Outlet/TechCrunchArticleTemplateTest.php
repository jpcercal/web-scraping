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

use Cekurte\WebScrapingBundle\Selector\Core\LinkSelector;
use Cekurte\WebScrapingBundle\Selector\Core\MetaSelector;
use Cekurte\WebScrapingBundle\Selector\Outlet\TechCrunchArticleSelector;
use Cekurte\WebScrapingBundle\Selector\Outlet\TechCrunchAuthorSelector;
use Cekurte\WebScrapingBundle\Template\Core\ArticleTemplateInterface;
use Cekurte\WebScrapingBundle\Template\Outlet\TechCrunchArticleTemplate;
use Symfony\Component\DomCrawler\Crawler;

class TechCrunchArticleTemplateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ArticleTemplateInterface
     */
    private $article;

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
    <link href="fakeurl" rel="canonical" />
</head>
<body>
    <article>
        <div class="article-header">
            <h1 class="tweet-title">ArticleTitle</h1>
            <a rel="author" href="fake_href_profile">AuthorName</a>
            <div class="twitter-handle">
                <a>Twitter</a>
            </div>
            <div class="byline">
                <time class="timestamp" datetime="2015-06-27"></time>
            </div>
        </div>
        <div class="article-entry">
            <p>P1</p>
            <p>P2</p>
        </div>
    </article>
</body>
</html>
EOT;

        $this->article = new TechCrunchArticleTemplate(
            new Crawler($body),
            new TechCrunchArticleSelector(
                new TechCrunchAuthorSelector(),
                new MetaSelector(),
                new LinkSelector()
            )
        );
    }

    public function testImplementsArticleTemplateInterface()
    {
        $reflection = new \ReflectionClass(
            '\\Cekurte\\WebScrapingBundle\\Template\\Outlet\\TechCrunchArticleTemplate'
        );

        $this->assertTrue($reflection->implementsInterface(
            '\\Cekurte\\WebScrapingBundle\\Template\\Core\\ArticleTemplateInterface'
        ));
    }

    public function testGetTitle()
    {
        $this->assertEquals('ArticleTitle', $this->article->getTitle());
    }

    public function testGetImage()
    {
        $this->assertEquals('og_image', $this->article->getImage());
    }

    public function testGetUrl()
    {
        $this->assertEquals('fakeurl', $this->article->getUrl());
    }

    public function testGetAbstract()
    {
        $this->assertEquals('P1', $this->article->getAbstract());
    }

    public function testGetContent()
    {
        $crawler = new Crawler($this->article->getContent());

        $this->assertEquals(2, $crawler->filter('p')->count());

        $this->assertEquals('P1', $crawler->filter('p')->first()->text());
        $this->assertEquals('P2', $crawler->filter('p')->last()->text());
    }

    public function testGetPublicationDate()
    {
        $this->assertInstanceOf('\\DateTime', $this->article->getPublicationDate());

        $this->assertEquals('2015', $this->article->getPublicationDate()->format('Y'));
        $this->assertEquals('06', $this->article->getPublicationDate()->format('m'));
        $this->assertEquals('27', $this->article->getPublicationDate()->format('d'));
    }

    public function testGetAuthor()
    {
        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Template\\Core\\AuthorTemplateInterface',
            $this->article->getAuthor()
        );
    }

    public function testGetMeta()
    {
        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Template\\Core\\MetaTemplateInterface',
            $this->article->getMeta()
        );
    }

    public function testGetLink()
    {
        $this->assertInstanceOf(
            '\\Cekurte\\WebScrapingBundle\\Template\\Core\\LinkTemplateInterface',
            $this->article->getLink()
        );
    }
}
