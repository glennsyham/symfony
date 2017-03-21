<?php

namespace AppBundle\Respository;

use Doctrine\ORM\EntityRepository;

class VpsCpanelRespository extends EntityRepository
{
    /*
    SELECT vps_cpanel.* FROM `vps_cpanel`
    LEFT JOIN vps_cpanel_conn on `vps_cpanel`.id =
    vpscpanel_id and vpsos_id = 18 WHERE vpsos_id is
    NUll ORDER BY `vps_cpanel_desc` ASC
    */
    public function findNoCpCpanelConnbyId($id)
    {
        return $this->createQueryBuilder("vps_cpanel")
            ->leftJoin(
                'vps_cpanel.cpcpanelconn',
                'c',
                "WITH",
                "c.vpsos_id = :id"
            )
            ->where('c.vpsos_id is NUll')
            ->setParameter('id', $id)
            ->orderBy('vps_cpanel.id', 'ASC');
    }
}
