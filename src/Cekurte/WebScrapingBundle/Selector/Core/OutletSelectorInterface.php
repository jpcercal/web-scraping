<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\WebScrapingBundle\Selector\Core;

use Cekurte\WebScrapingBundle\Selector\SelectorInterface;

interface OutletSelectorInterface
{
    /**
     * @return SelectorInterface
     */
    public function getName();

    /**
     * @return SelectorInterface
     */
    public function getDescription();
}
