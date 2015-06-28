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

use Cekurte\WebScrapingBundle\Selector\SelectorBuilder;

class LinkSelector implements LinkSelectorInterface
{
    /**
     * @inheritdoc
     */
    public function getCanonical()
    {
        return SelectorBuilder::create()
            ->setSelectorKey('link[rel="canonical"]')
            ->setSelectorType(SelectorBuilder::NODE_ATTR)
            ->setSelectorAttr('href')
        ;
    }
}
