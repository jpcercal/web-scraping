<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\WebScrapingBundle\Selector\Outlet;

use Cekurte\WebScrapingBundle\Selector\Core\ArticleSelectorInterface;
use Cekurte\WebScrapingBundle\Selector\Core\AuthorSelectorInterface;
use Cekurte\WebScrapingBundle\Selector\Core\LinkSelectorInterface;
use Cekurte\WebScrapingBundle\Selector\Core\MetaSelectorInterface;
use Cekurte\WebScrapingBundle\Selector\SelectorBuilder;

class TechCrunchArticleSelector implements ArticleSelectorInterface
{
    /**
     * @var AuthorSelectorInterface
     */
    private $authorSelector;

    /**
     * @var MetaSelectorInterface
     */
    private $metaSelector;

    /**
     * @var LinkSelectorInterface
     */
    private $linkSelector;

    /**
     * @param AuthorSelectorInterface $authorSelector
     * @param MetaSelectorInterface   $metaSelector
     * @param LinkSelectorInterface   $linkSelector
     */
    public function __construct(
        AuthorSelectorInterface $authorSelector,
        MetaSelectorInterface   $metaSelector,
        LinkSelectorInterface   $linkSelector
    ) {
        $this->authorSelector = $authorSelector;
        $this->metaSelector   = $metaSelector;
        $this->linkSelector   = $linkSelector;
    }

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        return SelectorBuilder::create()
            ->setSelectorKey('article .article-header h1.tweet-title')
            ->setSelectorType(SelectorBuilder::NODE_TEXT)
        ;
    }

    /**
     * @inheritdoc
     */
    public function getImage()
    {
        return $this->getMeta()->getOgImage();
    }

    /**
     * @inheritdoc
     */
    public function getUrl()
    {
        return $this->getLink()->getCanonical();
    }

    /**
     * @inheritdoc
     */
    public function getAbstract()
    {
        return SelectorBuilder::create()
            ->setSelectorKey('article .article-entry p')
            ->setSelectorType(SelectorBuilder::NODE_HTML)
        ;
    }

    /**
     * @inheritdoc
     */
    public function getContent()
    {
        return SelectorBuilder::create()
            ->setSelectorKey('article .article-entry')
            ->setSelectorType(SelectorBuilder::NODE_HTML)
        ;
    }

    /**
     * @inheritdoc
     */
    public function getPublicationDate()
    {
        return SelectorBuilder::create()
            ->setSelectorKey('article .article-header .byline time.timestamp')
            ->setSelectorType(SelectorBuilder::NODE_ATTR)
            ->setSelectorAttr('datetime')
        ;
    }

    /**
     * @inheritdoc
     */
    public function getAuthor()
    {
        return $this->authorSelector;
    }

    /**
     * @inheritdoc
     */
    public function getMeta()
    {
        return $this->metaSelector;
    }

    /**
     * @inheritdoc
     */
    public function getLink()
    {
        return $this->linkSelector;
    }
}
