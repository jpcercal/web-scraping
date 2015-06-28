<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\WebScrapingBundle\Service;

use Cekurte\WebScrapingBundle\Entity\Outlet;
use Cekurte\WebScrapingBundle\Selector\Core\ArticleSelectorInterface;
use Cekurte\WebScrapingBundle\Selector\Core\LinkSelector;
use Cekurte\WebScrapingBundle\Selector\Core\MetaSelector;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Symfony\Component\DomCrawler\Crawler;

class WebScrapingArticle
{
    /**
     * @var Outlet
     */
    private $outlet;

    /**
     * @var array
     */
    private $entries;

    /**
     * @var array
     */
    private $articles;

    /**
     * @param Outlet $outlet
     * @param array  $entries
     */
    public function __construct(Outlet $outlet, array $entries)
    {
        $this->outlet  = $outlet;
        $this->entries = $entries;
    }

    /**
     * @param  string $type
     * @return string
     */
    private function getTemplateClassname($type)
    {
        return sprintf(
            'Cekurte\\WebScrapingBundle\\Template\\Outlet\\%s%sTemplate',
            $this->getOutlet()->getName(),
            $type
        );
    }

    /**
     * @param  string $type
     * @return string
     */
    private function getSelectorClassname($type)
    {
        return sprintf(
            'Cekurte\\WebScrapingBundle\\Selector\\Outlet\\%s%sSelector',
            $this->getOutlet()->getName(),
            $type
        );
    }

    /**
     * @return ArticleSelectorInterface
     */
    private function getArticleSelector()
    {
        $classNameSelectorArticle = $this->getSelectorClassname('Article');
        $classNameSelectorAuthor  = $this->getSelectorClassname('Author');

        return new $classNameSelectorArticle(
            new $classNameSelectorAuthor,
            new MetaSelector(),
            new LinkSelector()
        );
    }

    /**
     * @return Outlet
     */
    public function getOutlet()
    {
        return $this->outlet;
    }

    /**
     * @return array
     */
    public function getEntries()
    {
        return $this->entries;
    }

    /**
     * @return array
     */
    public function getArticles()
    {
        if (empty($this->articles)) {

            $client  = new Client();

            $entries = $this->getEntries();

            $articleSelector = $this->getArticleSelector();

            foreach ($entries as $entry) {
                $request = new Request('GET', $entry->getLink());

                $response = $client->send($request);

                $crawler = new Crawler($response->getBody()->getContents());

                $classNameTemplateArticle = $this->getTemplateClassname('Article');

                $this->articles[] = new $classNameTemplateArticle(
                    $crawler,
                    $articleSelector
                );
            }
        }

        return $this->articles;
    }
}
