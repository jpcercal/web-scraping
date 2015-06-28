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

interface AuthorTemplateInterface
{
    /**
     * @return string|null
     */
    public function getName();

    /**
     * @return string|null
     */
    public function getImage();

    /**
     * @return string|null
     */
    public function getBiography();

    /**
     * @return string|null
     */
    public function getProfileUrl();

    /**
     * @return string|null
     */
    public function getFacebook();

    /**
     * @return string|null
     */
    public function getTwitter();
}
