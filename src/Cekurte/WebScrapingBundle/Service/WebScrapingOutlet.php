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
use Cekurte\WebScrapingBundle\Selector\Core\MetaSelector;
use Cekurte\WebScrapingBundle\Template\Core\OutletTemplateInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Symfony\Component\DomCrawler\Crawler;

class WebScrapingOutlet
{
    /**
     * @var Outlet
     */
    private $outlet;

    /**
     * @var OutletTemplateInterface
     */
    private $outletTemplate;

    /**
     * @param Outlet $outlet
     */
    public function __construct(Outlet $outlet)
    {
        $this->outlet = $outlet;
    }



    /**
     * @return string
     */
    private function getTemplateClassname()
    {
        return sprintf(
            'Cekurte\\WebScrapingBundle\\Template\\Outlet\\%sOutletTemplate',
            $this->getOutlet()->getName()
        );
    }

    /**
     * @return string
     */
    private function getSelectorClassname()
    {
        return sprintf(
            'Cekurte\\WebScrapingBundle\\Selector\\Outlet\\%sOutletSelector',
            $this->getOutlet()->getName()
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
     * @return OutletTemplateInterface
     */
    public function getOutletTemplate()
    {
        if (!$this->outletTemplate instanceof OutletTemplateInterface) {
            $client = new Client();

            $request = new Request('GET', $this->getOutlet()->getUrl());

            $response = $client->send($request);

            $crawler = new Crawler($response->getBody()->getContents());

            $classNameTemplate = $this->getTemplateClassname();

            $classNameSelector = $this->getSelectorClassname();

            $this->outletTemplate = new $classNameTemplate(
                $crawler,
                new $classNameSelector(new MetaSelector())
            );
        }

        return $this->outletTemplate;
    }
}
