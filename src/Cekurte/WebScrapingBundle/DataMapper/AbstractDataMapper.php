<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\WebScrapingBundle\DataMapper;

use Cekurte\ComponentBundle\Service\ResourceManagerInterface;
use Cekurte\WebScrapingBundle\Template\Core\ArticleTemplateInterface;
use Cekurte\WebScrapingBundle\Template\Core\OutletTemplateInterface;

abstract class AbstractDataMapper implements DataMapperInterface
{
    /**
     * @var ArticleTemplateInterface
     */
    protected $articleTemplate;

    /**
     * @var OutletTemplateInterface
     */
    protected $outletTemplate;

    /**
     * @var ResourceManagerInterface
     */
    protected $articleResourceManager;

    /**
     * @var ResourceManagerInterface
     */
    protected $authorResourceManager;

    /**
     * @var ResourceManagerInterface
     */
    protected $outletResourceManager;

    /**
     * @param ArticleTemplateInterface $articleTemplate
     * @param OutletTemplateInterface  $outletTemplate
     * @param ResourceManagerInterface $articleResourceManager
     * @param ResourceManagerInterface $authorResourceManager
     * @param ResourceManagerInterface $outletResourceManager
     */
    public function __construct(
        ArticleTemplateInterface $articleTemplate,
        OutletTemplateInterface  $outletTemplate,
        ResourceManagerInterface $articleResourceManager,
        ResourceManagerInterface $authorResourceManager,
        ResourceManagerInterface $outletResourceManager
    ) {
        $this->articleTemplate = $articleTemplate;
        $this->outletTemplate  = $outletTemplate;

        $this->articleResourceManager = $articleResourceManager;
        $this->authorResourceManager  = $authorResourceManager;
        $this->outletResourceManager  = $outletResourceManager;
    }

    /**
     * @inheritdoc
     */
    public function getArticle()
    {
        return $this->articleTemplate;
    }

    /**
     * @inheritdoc
     */
    public function getOutlet()
    {
        return $this->outletTemplate;
    }

    /**
     * @inheritdoc
     */
    public function getArticleResourceManager()
    {
        return $this->articleResourceManager;
    }

    /**
     * @inheritdoc
     */
    public function getAuthorResourceManager()
    {
        return $this->authorResourceManager;
    }

    /**
     * @inheritdoc
     */
    public function getOutletResourceManager()
    {
        return $this->outletResourceManager;
    }
}
