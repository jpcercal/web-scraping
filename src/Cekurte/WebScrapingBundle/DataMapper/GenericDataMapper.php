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

use Cekurte\ComponentBundle\Exception\ResourceNotFoundException;
use Cekurte\ComponentBundle\Service\ResourceManager\ResourceInterface;
use Cekurte\WebScrapingBundle\Entity\Article;
use Cekurte\WebScrapingBundle\Entity\Author;
use Cekurte\WebScrapingBundle\Entity\Outlet;

class GenericDataMapper extends AbstractDataMapper
{
    /**
     * @return Outlet
     */
    protected function getOutletResource()
    {
        return $this->getOutletResourceManager()->findResource(array(
            'name' => $this->getOutlet()->getName(),
        ));
    }

    /**
     * @return Author
     */
    protected function getAuthorResource()
    {
        try {

            $author = $this->getArticle()->getAuthor();

            $resource = $this->getAuthorResourceManager()->findResource(array(
                'name'   => $author->getName(),
                'outlet' => $this->getOutletResource()->getId(),
            ));

        } catch (ResourceNotFoundException $e) {
            $resource = new Author();

            $resource
                ->setName($author->getName())
                ->setImage($author->getImage())
                ->setBiography($author->getBiography())
                ->setFacebook($author->getFacebook())
                ->setTwitter($author->getTwitter())
                ->setProfileUrl($this->getOutletResource()->getUrl() . $author->getProfileUrl())
                ->setOutlet($this->getOutletResource())
            ;

            $this->getAuthorResourceManager()->writeResource($resource);
        }

        return $resource;
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        $article = $this->getArticle();

        $filters = $this
            ->getArticleResourceManager()
            ->getEntityManager()
            ->getFilters()
        ;

        $filters->disable('softdeleteable');

        try {

            $resource = $this->getArticleResourceManager()->findResource(array(
                'url' => $article->getUrl(),
            ));

        } catch (ResourceNotFoundException $e) {
            $resource = new Article();

            $resource->setViews(0);
        }

        $filters->enable('softdeleteable');

        if (!is_null($resource->getDeletedAt())) {
            return $resource->getId();
        }

        $resource
            ->setTitle($article->getTitle())
            ->setAbstract($article->getAbstract())
            ->setContent($article->getContent())
            ->setImage($article->getImage())
            ->setPublicationDate($article->getPublicationDate())
            ->setUrl($article->getUrl())
            ->setOutlet($this->getOutletResource())
            ->setAuthor($this->getAuthorResource())
        ;

        if ($resource->getId()) {
            $this->getArticleResourceManager()->updateResource($resource);
        } else {
            $this->getArticleResourceManager()->writeResource($resource);
        }

        return $resource->getId();
    }
}
