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
use Zend\Feed\Reader\Reader;

class WebScrapingFeed
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
     * @param Outlet $outlet
     */
    public function __construct(Outlet $outlet)
    {
        $this->outlet = $outlet;
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
        if (empty($this->entries)) {

            $feeds = $this->getOutlet()->getFeeds();

            foreach ($feeds as $feed) {
                $reader = Reader::import($feed->getUrl());

                foreach ($reader as $entry) {
                    $this->entries[] = $entry;
                }
            }
        }

        return $this->entries;
    }
}
