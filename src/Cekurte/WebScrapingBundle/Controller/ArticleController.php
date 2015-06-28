<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\WebScrapingBundle\Controller;

use Cekurte\ComponentBundle\Controller\ResourceController;
use Cekurte\ComponentBundle\HttpFoundation\SerializedResponse;
use Cekurte\ComponentBundle\Service\ResourceManagerInterface;
use JMS\DiExtraBundle\Annotation as DI;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends ResourceController
{
    /**
     * @DI\InjectParams({
     *     "resourceManager" = @DI\Inject("cekurte_webscraping.resource.article")
     * })
     *
     * @inheritdoc
     */
    public function __construct(ResourceManagerInterface $resourceManager)
    {
        parent::__construct($resourceManager);
    }

    /**
     * @Route("/article", name="article")
     * @Method("GET")
     *
     * @return SerializedResponse
     */
    public function indexAction()
    {
        $resources = $this->getResourceManager()->findResources(array());

        $data = array();

        foreach ($resources as $resource) {
            $data[] = array(
                'id'       => $resource->getId(),
                'slug'     => $resource->getSlug(),
                'title'    => $resource->getTitle(),
                'image'    => $resource->getImage(),
                'abstract' => $resource->getAbstract(),
            );
        }

        return new SerializedResponse($data, 200, array(
            'Content-type' => 'application/json'
        ));
    }

    /**
     * @Route("/article/search", name="article_search")
     * @Method("GET")
     *
     * @param  Request $request
     *
     * @return SerializedResponse
     */
    public function searchAction(Request $request)
    {
        $resources = $this
            ->getDoctrine()
            ->getRepository('CekurteWebScrapingBundle:Article')
            ->getSearchResources($request)
        ;

        $data = array();

        foreach ($resources as $resource) {
            $data[] = array(
                'id'       => $resource->getId(),
                'slug'     => $resource->getSlug(),
                'title'    => $resource->getTitle(),
                'image'    => $resource->getImage(),
                'abstract' => $resource->getAbstract(),
            );
        }

        return new SerializedResponse($data, 200, array(
            'Content-type' => 'application/json'
        ));
    }

    /**
     * @Route("/article/{id}", name="article_show")
     * @Method("GET")
     *
     * @param  int $id
     *
     * @return SerializedResponse
     */
    public function showAction($id)
    {
        $resource = $this->getResourceManager()->findResource(array(
            'id' => $id
        ));

        $resource->incrementViews();

        $this->getResourceManager()->updateResource($resource);

        $data = array(
            'id'               => $resource->getId(),
            'slug'             => $resource->getSlug(),
            'title'            => $resource->getTitle(),
            'image'            => $resource->getImage(),
            'abstract'         => $resource->getAbstract(),
            'outlet'           => array(
                'id'           => $resource->getOutlet()->getId(),
                'name'         => $resource->getOutlet()->getName(),
            ),
            'author'           => array(
                'id'           => $resource->getAuthor()->getId(),
                'name'         => $resource->getAuthor()->getName(),
            ),
            'views'            => $resource->getViews(),
            'created_at'       => $resource->getCreatedAt(),
            'updated_at'       => $resource->getUpdatedAt(),
            'publication_date' => $resource->getPublicationDate(),
            'content'          => $resource->getContent(),
        );

        return new SerializedResponse($data, 200, array(
            'Content-type' => 'application/json'
        ));
    }

    /**
     * @Route("/article/{id}", name="article_delete")
     * @Method("DELETE")
     *
     * @param  int $id
     *
     * @return SerializedResponse
     */
    public function deleteAction($id)
    {
        $resource = $this->getResourceManager()->findResource(array(
            'id' => $id
        ));

        $this->getResourceManager()->deleteResource($resource);

        return new SerializedResponse(null, 204, array(
            'Content-type' => 'application/json'
        ));
    }
}
