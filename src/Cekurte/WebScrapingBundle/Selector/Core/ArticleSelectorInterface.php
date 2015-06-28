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

interface ArticleSelectorInterface
{
    /**
     * @return SelectorInterface
     */
    public function getTitle();

    /**
     * @return SelectorInterface
     */
    public function getImage();

    /**
     * @return SelectorInterface
     */
    public function getUrl();

    /**
     * @return SelectorInterface
     */
    public function getAbstract();

    /**
     * @return SelectorInterface
     */
    public function getContent();

    /**
     * @return SelectorInterface
     */
    public function getPublicationDate();

    /**
     * @return AuthorSelectorInterface
     */
    public function getAuthor();

    /**
     * @return MetaSelectorInterface
     */
    public function getMeta();

    /**
     * @return LinkSelectorInterface
     */
    public function getLink();
}
