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

class SelectorBuilder implements SelectorInterface
{
    /**
     * Define node type attribute
     */
    const NODE_ATTR = 'attr';

    /**
     * Define node type text
     */
    const NODE_TEXT = 'text';

    /**
     * Define node type html
     */
    const NODE_HTML = 'html';

    /**
     * @param string
     */
    protected $selectorKey;

    /**
     * @param string
     */
    protected $selectorType;

    /**
     * @param string
     */
    protected $selectorAttr;

    /**
     * @return SelectorBuilder
     */
    public static function create()
    {
        return new static();
    }

    /**
     * @param  string $selectorKey
     *
     * @return SelectorBuilder
     *
     * @throw  InvalidArgumentException
     */
    public function setSelectorKey($selectorKey)
    {
        if (empty($selectorKey)) {
            throw new \InvalidArgumentException('The selector key can not be empty!');
        }

        if (!is_string($selectorKey)) {
            throw new \InvalidArgumentException('The selector key could be a string!');
        }

        $this->selectorKey = $selectorKey;

        return $this;
    }

    /**
     * @param  string $selectorType
     *
     * @return SelectorBuilder
     *
     * @throw  InvalidArgumentException
     */
    public function setSelectorType($selectorType)
    {
        if (empty($selectorType)) {
            throw new \InvalidArgumentException('The selector type can not be empty!');
        }

        if (!in_array($selectorType, $this->getSelectorTypes())) {
            throw new \InvalidArgumentException('The selector type can not be found!');
        }

        $this->selectorType = $selectorType;

        return $this;
    }

    /**
     * @param  string $selectorAttr
     *
     * @return SelectorBuilder
     *
     * @throw  InvalidArgumentException
     */
    public function setSelectorAttr($selectorAttr)
    {
        $selectorType = $this->getSelectorType();

        if (!in_array($selectorType, $this->getSelectorTypes())) {
            throw new \InvalidArgumentException('The selector type can not be found!');
        }

        if (empty($selectorAttr) && $selectorType === self::NODE_ATTR) {
            throw new \InvalidArgumentException('The selector attr can not be empty!');
        }

        if (!empty($selectorAttr) && $selectorType !== self::NODE_ATTR) {
            throw new \InvalidArgumentException('The selector attr could be empty!');
        }

        if (!is_string($selectorAttr)) {
            throw new \InvalidArgumentException('The selector type could be a string!');
        }

        $this->selectorAttr = $selectorAttr;

        return $this;
    }

    /**
     * @return array
     */
    public function getSelectorTypes()
    {
        return array(
            self::NODE_ATTR,
            self::NODE_TEXT,
            self::NODE_HTML,
        );
    }

    /**
     * @inheritdoc
     */
    public function getSelectorKey()
    {
        return $this->selectorKey;
    }

    /**
     * @inheritdoc
     */
    public function getSelectorType()
    {
        return $this->selectorType;
    }

    /**
     * @inheritdoc
     */
    public function getSelectorAttr()
    {
        return $this->selectorAttr;
    }
}
