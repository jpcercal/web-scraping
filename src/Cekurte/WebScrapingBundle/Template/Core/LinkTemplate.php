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

use Cekurte\WebScrapingBundle\Selector\Core\LinkSelectorInterface;
use Cekurte\WebScrapingBundle\Selector\SelectorResolver;
use Symfony\Component\DomCrawler\Crawler;

class LinkTemplate implements LinkTemplateInterface
{
    /**
     * @var Crawler
     */
    private $crawler;

    /**
     * @var LinkSelectorInterface
     */
    private $selector;

    /**
     * @param Crawler               $crawler
     * @param LinkSelectorInterface $selector
     */
    public function __construct(Crawler $crawler, LinkSelectorInterface $selector)
    {
        $this->crawler  = $crawler;
        $this->selector = $selector;
    }

    /**
     * @inheritdoc
     */
    public function getCanonical()
    {
        return SelectorResolver::create()
            ->resolve($this->crawler, $this->selector->getCanonical())
            ->getSingleResult()
        ;
    }
}
