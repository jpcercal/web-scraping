<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\WebScrapingBundle\Template\Core;

use Cekurte\WebScrapingBundle\Selector\Core\MetaSelectorInterface;
use Cekurte\WebScrapingBundle\Selector\SelectorResolver;
use Symfony\Component\DomCrawler\Crawler;

class MetaTemplate implements MetaTemplateInterface
{
    /**
     * @var Crawler
     */
    private $crawler;

    /**
     * @var MetaSelectorInterface
     */
    private $selector;

    /**
     * @param Crawler               $crawler
     * @param MetaSelectorInterface $selector
     */
    public function __construct(Crawler $crawler, MetaSelectorInterface $selector)
    {
        $this->crawler  = $crawler;
        $this->selector = $selector;
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return SelectorResolver::create()
            ->resolve($this->crawler, $this->selector->getDescription())
            ->getSingleResult()
        ;
    }

    /**
     * @inheritdoc
     */
    public function getKeywords()
    {
        $content = SelectorResolver::create()
            ->resolve($this->crawler, $this->selector->getKeywords())
            ->getSingleResult()
        ;

        if (empty($content)) {
            return array();
        }

        if (strpos($content, ',') !== false) {
            $keywords = explode(',', $content);
        } elseif (substr_count($content, ' ') > 4) {
            $keywords = explode(' ', $content);
        } else {
            $keywords = array($content);
        }

        array_walk($keywords, function($item, $key) use (&$keywords) {
            if (is_numeric(trim($item))) {
                unset($keywords[$key]);
            } else {
                $item = trim(strtolower($item));
            }
        });

        return array_unique($keywords);
    }

    /**
     * @inheritdoc
     */
    public function getCharset()
    {
        return SelectorResolver::create()
            ->resolve($this->crawler, $this->selector->getCharset())
            ->getSingleResult()
        ;
    }

    /**
     * @inheritdoc
     */
    public function getOgSiteName()
    {
        return SelectorResolver::create()
            ->resolve($this->crawler, $this->selector->getOgSiteName())
            ->getSingleResult()
        ;
    }

    /**
     * @inheritdoc
     */
    public function getOgTitle()
    {
        return SelectorResolver::create()
            ->resolve($this->crawler, $this->selector->getOgTitle())
            ->getSingleResult()
        ;
    }

    /**
     * @inheritdoc
     */
    public function getOgDescription()
    {
        return SelectorResolver::create()
            ->resolve($this->crawler, $this->selector->getOgDescription())
            ->getSingleResult()
        ;
    }

    /**
     * @inheritdoc
     */
    public function getOgImage()
    {
        return SelectorResolver::create()
            ->resolve($this->crawler, $this->selector->getOgImage())
            ->getSingleResult()
        ;
    }

    /**
     * @inheritdoc
     */
    public function getOgUrl()
    {
        return SelectorResolver::create()
            ->resolve($this->crawler, $this->selector->getOgUrl())
            ->getSingleResult()
        ;
    }
}
