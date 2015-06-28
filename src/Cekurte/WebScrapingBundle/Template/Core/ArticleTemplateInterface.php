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

interface ArticleTemplateInterface
{
    /**
     * @return string|null
     */
    public function getTitle();

    /**
     * @return string|null
     */
    public function getImage();

    /**
     * @return string|null
     */
    public function getUrl();

    /**
     * @return string|null
     */
    public function getAbstract();

    /**
     * @return string|null
     */
    public function getContent();

    /**
     * @return \DateTime
     */
    public function getPublicationDate();

    /**
     * @return AuthorTemplateInterface
     */
    public function getAuthor();

    /**
     * @return MetaTemplateInterface
     */
    public function getMeta();

    /**
     * @return LinkTemplateInterface
     */
    public function getLink();
}
