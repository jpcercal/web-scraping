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
use Cekurte\WebScrapingBundle\Entity\Author;
use JMS\DiExtraBundle\Annotation as DI;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class OutletController extends ResourceController
{
    /**
     * @DI\InjectParams({
     *     "resourceManager" = @DI\Inject("cekurte_webscraping.resource.outlet")
     * })
     *
     * @inheritdoc
     */
    public function __construct(ResourceManagerInterface $resourceManager)
    {
        parent::__construct($resourceManager);
    }

    /**
     * @Route("/outlet", name="outlet")
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
                'id'          => $resource->getId(),
                'name'        => $resource->getName(),
                'description' => $resource->getDescription(),
                'url'         => $resource->getUrl(),
            );
        }

        return new SerializedResponse($data, 200, array(
            'Content-type' => 'application/json'
        ));
    }

    /**
     * @Route("/outlet/{id}", name="outlet_show")
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

        $data = array(
            'id'          => $resource->getId(),
            'name'        => $resource->getName(),
            'description' => $resource->getDescription(),
            'url'         => $resource->getUrl(),
            'created_at'  => $resource->getCreatedAt(),
            'updated_at'  => $resource->getUpdatedAt(),
            'articles'    => count($resource->getArticles()),
            'authors'     => count($resource->getAuthors()),
            'feeds'       => count($resource->getFeeds()),
        );

        return new SerializedResponse($data, 200, array(
            'Content-type' => 'application/json'
        ));
    }
}
