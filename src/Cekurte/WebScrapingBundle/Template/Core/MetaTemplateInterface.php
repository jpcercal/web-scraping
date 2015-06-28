<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\WebScrapingBundle\Template\Core;

interface MetaTemplateInterface
{
    /**
     * @return string|null
     */
    public function getDescription();

    /**
     * @return array
     */
    public function getKeywords();

    /**
     * @return string|null
     */
    public function getCharset();

    /**
     * @return string|null
     */
    public function getOgSiteName();

    /**
     * @return string|null
     */
    public function getOgTitle();

    /**
     * @return string|null
     */
    public function getOgDescription();

    /**
     * @return string|null
     */
    public function getOgImage();

    /**
     * @return string|null
     */
    public function getOgUrl();
}
