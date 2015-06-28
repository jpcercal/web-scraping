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

use Cekurte\WebScrapingBundle\Selector\Core\AuthorSelectorInterface;
use Cekurte\WebScrapingBundle\Selector\SelectorResolver;
use Cekurte\WebScrapingBundle\Template\Core\AuthorTemplateInterface;
use Symfony\Component\DomCrawler\Crawler;

class TechCrunchAuthorTemplate implements AuthorTemplateInterface
{
    /**
     * @var Crawler
     */
    private $crawler;

    /**
     * @var AuthorSelectorInterface
     */
    private $selector;

    /**
     * @param Crawler                 $crawler
     * @param AuthorSelectorInterface $selector
     */
    public function __construct(Crawler $crawler, AuthorSelectorInterface $selector)
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
    public function getImage()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getBiography()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getProfileUrl()
    {
        return SelectorResolver::create()
            ->resolve($this->crawler, $this->selector->getProfileUrl())
            ->getSingleResult()
        ;
    }

    /**
     * @inheritdoc
     */
    public function getFacebook()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getTwitter()
    {
        return SelectorResolver::create()
            ->resolve($this->crawler, $this->selector->getTwitter())
            ->getSingleResult()
        ;
    }
}
