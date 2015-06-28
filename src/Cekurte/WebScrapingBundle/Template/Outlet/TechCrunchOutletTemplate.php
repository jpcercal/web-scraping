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

use Cekurte\WebScrapingBundle\Selector\Core\OutletSelectorInterface;
use Cekurte\WebScrapingBundle\Selector\SelectorResolver;
use Cekurte\WebScrapingBundle\Template\Core\OutletTemplateInterface;
use Symfony\Component\DomCrawler\Crawler;

class TechCrunchOutletTemplate implements OutletTemplateInterface
{
    /**
     * @var Crawler
     */
    private $crawler;

    /**
     * @var OutletSelectorInterface
     */
    private $selector;

    /**
     * @param Crawler                 $crawler
     * @param OutletSelectorInterface $selector
     */
    public function __construct(Crawler $crawler, OutletSelectorInterface $selector)
    {
        $this->crawler  = $crawler;
        $this->selector = $selector;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return SelectorResolver::create()
            ->resolve($this->crawler, $this->selector->getName())
            ->getSingleResult()
        ;
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
}
