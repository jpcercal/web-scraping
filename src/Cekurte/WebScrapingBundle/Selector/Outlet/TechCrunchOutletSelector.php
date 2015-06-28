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

use Cekurte\WebScrapingBundle\Selector\Core\MetaSelectorInterface;
use Cekurte\WebScrapingBundle\Selector\Core\OutletSelectorInterface;

class TechCrunchOutletSelector implements OutletSelectorInterface
{
    /**
     * @var MetaSelectorInterface
     */
    private $metaSelector;

    /**
     * @param MetaSelectorInterface $metaSelector
     */
    public function __construct(MetaSelectorInterface $metaSelector)
    {
        $this->metaSelector = $metaSelector;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->metaSelector->getOgSiteName();
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return $this->metaSelector->getOgDescription();
    }
}
