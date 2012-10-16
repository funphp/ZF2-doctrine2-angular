<?php

namespace Api\Repositories;

use Doctrine\ORM\EntityRepository;

/**
 * OauthTokenRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class OauthTokenRepository extends EntityRepository
{
    public function findByKeyAndAccessToken($consumerKey, $accessToken)
    {
       
        $qb = $this->createQueryBuilder('ot')
                ->innerJoin('ot.oauthKey', 'key')
                ->where('ot.token = :token')
                ->andWhere('key.consumerKey = :consumerKey')
                ->setParameters(array('token'=>$accessToken, 'consumerKey'=>$consumerKey));
     

        $query = $qb->getQuery();
       
        return $query->getOneOrNullResult();
    }
}