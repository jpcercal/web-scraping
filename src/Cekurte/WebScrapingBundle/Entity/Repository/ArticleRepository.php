<?php

/*
 * This file is part of the Cekurte package.
 *
 * (c) João Paulo Cercal <jpcercal@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cekurte\WebScrapingBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;

class ArticleRepository extends EntityRepository
{
    /**
     * @param  Request $request
     *
     * @return array
     */
    public function getSearchResources(Request $request)
    {
        $queryBuilder = $this->createQueryBuilder('ck');

        $params = $request->query->all();

        if (isset($params['title'])) {
            $queryBuilder
                ->andWhere($queryBuilder->expr()->like('ck.title', ':title'))
                ->setParameter('title', trim(sprintf('%%%s%%', $params['title'])))
            ;
        }

        if (isset($params['slug'])) {
            $queryBuilder
                ->andWhere($queryBuilder->expr()->like('ck.slug', ':slug'))
                ->setParameter('slug', trim(sprintf('%%%s%%', $params['slug'])))
            ;
        }

        if (isset($params['content'])) {
            $queryBuilder
                ->andWhere($queryBuilder->expr()->like('ck.content', ':content'))
                ->setParameter('content', trim(sprintf('%%%s%%', $params['content'])))
            ;
        }

        if (isset($params['authorId'])) {
            $queryBuilder
                ->andWhere($queryBuilder->expr()->eq('ck.author', ':authorId'))
                ->setParameter('authorId', trim($params['authorId']))
            ;
        }

        if (isset($params['outletId'])) {
            $queryBuilder
                ->andWhere($queryBuilder->expr()->eq('ck.outlet', ':outletId'))
                ->setParameter('outletId', trim($params['outletId']))
            ;
        }

        return $queryBuilder->getQuery()->getResult();
    }
}
