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

interface MetaSelectorInterface
{
    /**
     * @param  string $name
     *
     * @return SelectorInterface
     */
    public function getMeta($name);

    /**
     * @param  string $name
     *
     * @return SelectorInterface
     */
    public function getOgMeta($name);

    /**
     * @param  string $selectorKey
     * @param  string $selectorAttr
     *
     * @return SelectorInterface
     */
    public function getCustomMeta($selectorKey, $selectorAttr);

    /**
     * @return SelectorInterface
     */
    public function getDescription();

    /**
     * @return SelectorInterface
     */
    public function getKeywords();

    /**
     * @return SelectorInterface
     */
    public function getCharset();

    /**
     * @return SelectorInterface
     */
    public function getOgSiteName();

    /**
     * @return SelectorInterface
     */
    public function getOgTitle();

    /**
     * @return SelectorInterface
     */
    public function getOgDescription();

    /**
     * @return SelectorInterface
     */
    public function getOgImage();

    /**
     * @return SelectorInterface
     */
    public function getOgUrl();
}
