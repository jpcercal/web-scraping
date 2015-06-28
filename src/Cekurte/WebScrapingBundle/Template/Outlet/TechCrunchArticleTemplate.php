<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\WebScrapingBundle\Template\Outlet;

use Cekurte\WebScrapingBundle\Selector\Core\ArticleSelectorInterface;
use Cekurte\WebScrapingBundle\Selector\SelectorResolver;
use Cekurte\WebScrapingBundle\Template\Core\ArticleTemplateInterface;
use Cekurte\WebScrapingBundle\Template\Core\AuthorTemplateInterface;
use Cekurte\WebScrapingBundle\Template\Core\LinkTemplate;
use Cekurte\WebScrapingBundle\Template\Core\MetaTemplate;
use Cekurte\WebScrapingBundle\Template\Core\MetaTemplateInterface;
use Cekurte\WebScrapingBundle\Template\Core\OutletTemplateInterface;
use Symfony\Component\DomCrawler\Crawler;

class TechCrunchArticleTemplate implements ArticleTemplateInterface
{
    /**
     * @var Crawler
     */
    private $crawler;

    /**
     * @var ArticleSelectorInterface
     */
    private $selector;

    /**
     * @var AuthorTemplateInterface
     */
    private $authorTemplate;

    /**
     * @var MetaTemplateInterface
     */
    private $metaTemplate;

    /**
     * @var LinkTemplateInterface
     */
    private $linkTemplate;

    /**
     * @param Crawler                  $crawler
     * @param ArticleSelectorInterface $selector
     */
    public function __construct(Crawler $crawler, ArticleSelectorInterface $selector)
    {
        $this->crawler  = $crawler;
        $this->selector = $selector;

        $this->authorTemplate = new TechCrunchAuthorTemplate($crawler, $selector->getAuthor());
        $this->metaTemplate   = new MetaTemplate($crawler, $selector->getMeta());
        $this->linkTemplate   = new LinkTemplate($crawler, $selector->getLink());
    }

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        return SelectorResolver::create()
            ->resolve($this->crawler, $this->selector->getTitle())
            ->getSingleResult()
        ;
    }

    /**
     * @inheritdoc
     */
    public function getImage()
    {
        return SelectorResolver::create()
            ->resolve($this->crawler, $this->selector->getImage())
            ->getSingleResult()
        ;
    }

    /**
     * @inheritdoc
     */
    public function getUrl()
    {
        return SelectorResolver::create()
            ->resolve($this->crawler, $this->selector->getUrl())
            ->getSingleResult()
        ;
    }

    /**
     * @inheritdoc
     */
    public function getAbstract()
    {
        return SelectorResolver::create()
            ->resolve($this->crawler, $this->selector->getAbstract())
            ->getSingleResult()
        ;
    }

    /**
     * @inheritdoc
     */
    public function getContent()
    {
        return SelectorResolver::create()
            ->resolve($this->crawler, $this->selector->getContent())
            ->getSingleResult()
        ;
    }

    /**
     * @inheritdoc
     */
    public function getPublicationDate()
    {
        $dateStr = SelectorResolver::create()
            ->resolve($this->crawler, $this->selector->getPublicationDate())
            ->getSingleResult()
        ;

        return \DateTime::createFromFormat('Y-m-d', $dateStr);
    }

    /**
     * @inheritdoc
     */
    public function getAuthor()
    {
        return $this->authorTemplate;
    }

    /**
     * @inheritdoc
     */
    public function getMeta()
    {
        return $this->metaTemplate;
    }

    /**
     * @inheritdoc
     */
    public function getLink()
    {
        return $this->linkTemplate;
    }
}
