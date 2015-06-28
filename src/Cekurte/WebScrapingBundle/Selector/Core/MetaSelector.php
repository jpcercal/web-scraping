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

class MetaSelector implements MetaSelectorInterface
{
    /**
     * @inheritdoc
     */
    public function getMeta($name)
    {
        return SelectorBuilder::create()
            ->setSelectorKey(sprintf('meta[name="%s"]', $name))
            ->setSelectorType(SelectorBuilder::NODE_ATTR)
            ->setSelectorAttr('content')
        ;
    }

    /**
     * @inheritdoc
     */
    public function getOgMeta($name)
    {
        return SelectorBuilder::create()
            ->setSelectorKey(sprintf('meta[property="og:%s"]', $name))
            ->setSelectorType(SelectorBuilder::NODE_ATTR)
            ->setSelectorAttr('content')
        ;
    }

    /**
     * @inheritdoc
     */
    public function getCustomMeta($selectorKey, $selectorAttr)
    {
        return SelectorBuilder::create()
            ->setSelectorKey(sprintf('meta[%s]', $selectorKey))
            ->setSelectorType(SelectorBuilder::NODE_ATTR)
            ->setSelectorAttr($selectorAttr)
        ;
    }

    /**
     * @inheritdoc
     */
    public function getDescription()
    {
        return $this->getMeta('description');
    }

    /**
     * @inheritdoc
     */
    public function getKeywords()
    {
        return $this->getMeta('keywords');
    }

    /**
     * @inheritdoc
     */
    public function getCharset()
    {
        return $this->getMeta('charset');
    }

    /**
     * @inheritdoc
     */
    public function getOgSiteName()
    {
        return $this->getOgMeta('site_name');
    }

    /**
     * @inheritdoc
     */
    public function getOgTitle()
    {
        return $this->getOgMeta('title');
    }

    /**
     * @inheritdoc
     */
    public function getOgDescription()
    {
        return $this->getOgMeta('description');
    }

    /**
     * @inheritdoc
     */
    public function getOgImage()
    {
        return $this->getOgMeta('image');
    }

    /**
     * @inheritdoc
     */
    public function getOgUrl()
    {
        return $this->getOgMeta('url');
    }
}
