<?php

namespace AppBundle\Respository;

use Doctrine\ORM\EntityRepository;

class VpsOsRespository extends EntityRepository
{
    public function findbyid($id)
    {
        return $this->createQueryBuilder('vps_os')
            ->andWhere('vps_os.id = :id')
            ->setParameter('id', $id)
            ->orderBy('vps_os.id', 'ASC');
    }
}
