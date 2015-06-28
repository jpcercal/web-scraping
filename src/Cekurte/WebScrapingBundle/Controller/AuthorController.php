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

class AuthorController extends ResourceController
{
    /**
     * @DI\InjectParams({
     *     "resourceManager" = @DI\Inject("cekurte_webscraping.resource.author")
     * })
     *
     * @inheritdoc
     */
    public function __construct(ResourceManagerInterface $resourceManager)
    {
        parent::__construct($resourceManager);
    }

    /**
     * @Route("/author", name="author")
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
                'slug'        => $resource->getSlug(),
                'name'        => $resource->getName(),
                'image'       => $resource->getImage(),
                'profile_url' => $resource->getProfileUrl(),
                'facebook'    => $resource->getFacebook(),
                'twitter'     => $resource->getTwitter(),
                'outlet'      => array(
                    'id'      => $resource->getOutlet()->getId(),
                    'name'    => $resource->getOutlet()->getName(),
                ),
            );
        }

        return new SerializedResponse($data, 200, array(
            'Content-type' => 'application/json'
        ));
    }

    /**
     * @Route("/author/{id}", name="author_show")
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
            'slug'        => $resource->getSlug(),
            'name'        => $resource->getName(),
            'image'       => $resource->getImage(),
            'profile_url' => $resource->getProfileUrl(),
            'facebook'    => $resource->getFacebook(),
            'twitter'     => $resource->getTwitter(),
            'articles'    => count($resource->getArticles()),
            'outlet'      => array(
                'id'      => $resource->getOutlet()->getId(),
                'name'    => $resource->getOutlet()->getName(),
            ),
            'biography'   => $resource->getBiography(),
            'created_at'  => $resource->getCreatedAt(),
            'updated_at'  => $resource->getUpdatedAt(),
        );

        return new SerializedResponse($data, 200, array(
            'Content-type' => 'application/json'
        ));
    }
}
