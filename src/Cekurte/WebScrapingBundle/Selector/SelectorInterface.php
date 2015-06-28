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

interface SelectorInterface
{
    /**
     * @return string
     */
    public function getSelectorKey();

    /**
     * @return string
     */
    public function getSelectorType();

    /**
     * @return string
     */
    public function getSelectorAttr();
}
