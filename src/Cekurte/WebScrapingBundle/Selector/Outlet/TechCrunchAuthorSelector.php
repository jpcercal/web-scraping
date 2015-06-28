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

use Cekurte\WebScrapingBundle\Selector\Core\AuthorSelectorInterface;
use Cekurte\WebScrapingBundle\Selector\SelectorBuilder;

class TechCrunchAuthorSelector implements AuthorSelectorInterface
{
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return SelectorBuilder::create()
            ->setSelectorKey('article .article-header a[rel="author"]')
            ->setSelectorType(SelectorBuilder::NODE_TEXT)
        ;
    }

    /**
     * @inheritdoc
     */
    public function getImage()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getBiography()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getProfileUrl()
    {
        return SelectorBuilder::create()
            ->setSelectorKey('article .article-header a[rel="author"]')
            ->setSelectorType(SelectorBuilder::NODE_ATTR)
            ->setSelectorAttr('href')
        ;
    }

    /**
     * @inheritdoc
     */
    public function getFacebook()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getTwitter()
    {
        return SelectorBuilder::create()
            ->setSelectorKey('article .article-header .twitter-handle a')
            ->setSelectorType(SelectorBuilder::NODE_TEXT)
        ;
    }
}
