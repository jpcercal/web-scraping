<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\WebScrapingBundle\Selector;

use Symfony\Component\DomCrawler\Crawler;

class SelectorResolver
{
    /**
     * @var bool
     */
    protected $resolved;

    /**
     * @var array
     */
    protected $resolvedData;

    /**
     * Initialize Resolver
     */
    protected function __construct()
    {
        $this->resolved     = false;
        $this->resolvedData = array();
    }

    /**
     * @return SelectorResolver
     */
    public static function create()
    {
        return new static();
    }

    /**
     * @param  Crawler           $crawler
     * @param  SelectorInterface $selector
     *
     * @return SelectorResolver
     *
     * @throws SelectorCannotBeResolvedException
     */
    public function resolve(Crawler $crawler, SelectorInterface $selector)
    {
        $data = array();

        $this->resolvedData = null;

        $crawler->filter($selector->getSelectorKey())->each(function ($node) use ($selector, &$data, &$selectorResolved) {

            switch ($selector->getSelectorType()) {

                case SelectorBuilder::NODE_ATTR:
                    $resolvedData = $node->attr($selector->getSelectorAttr());
                    break;

                case SelectorBuilder::NODE_TEXT:
                    $resolvedData = $node->text();
                    break;

                case SelectorBuilder::NODE_HTML:
                    $resolvedData = $node->html();
                    break;
            }

            if (!empty($resolvedData)) {
                $data[] = trim($resolvedData);
            }

            $this->resolvedData = $data;
        });

        $this->resolved = true;

        return $this;
    }

    protected function isResolved()
    {
        return $this->resolved;
    }

    /**
     * @return string
     *
     * @throw  InvalidArgumentException
     */
    public function getSingleResult()
    {
        if (!$this->isResolved()) {
            throw new \InvalidArgumentException('Result not resolved.');
        }

        return isset($this->resolvedData[0]) ? $this->resolvedData[0] : '';
    }

    /**
     * @return array
     *
     * @throw  InvalidArgumentException
     */
    public function getResult()
    {
        if (!$this->isResolved()) {
            throw new \InvalidArgumentException('Result not resolved.');
        }

        return $this->resolvedData;
    }
}
