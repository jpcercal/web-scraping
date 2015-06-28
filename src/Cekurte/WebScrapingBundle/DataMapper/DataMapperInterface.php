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

interface DataMapperInterface
{
    /**
     * @return ArticleTemplateInterface
     */
    public function getArticle();

    /**
     * @return OutletTemplateInterface
     */
    public function getOutlet();

    /**
     * @return ResourceManagerInterface
     */
    public function getArticleResourceManager();

    /**
     * @return ResourceManagerInterface
     */
    public function getAuthorResourceManager();

    /**
     * @return ResourceManagerInterface
     */
    public function getOutletResourceManager();

    /**
     * @return bool|int
     */
    public function save();
}
