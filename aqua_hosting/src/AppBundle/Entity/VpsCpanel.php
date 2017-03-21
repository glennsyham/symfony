<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Respository\VpsCpanelRespository")
 * @ORM\Table(name="vps_cpanel")
 */
class VpsCpanel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $vps_cpanel_desc;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $vps_cpanel_price;


    /**
     * @ORM\OneToMany(targetEntity="VpsCpanelConn", mappedBy="vpscpanel")
     * @ORM\OrderBy({"id"="ASC"})
     */
    private $cpcpanelconn;

    /**
     * @ORM\OneToMany(targetEntity="VpsHosting",mappedBy="vpshosting")
     */
    private $vpshosting;

    public function __construct()
    {
        $this->cpcpanelconn = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getVpsCpanelDesc()
    {
        return $this->vps_cpanel_desc;
    }

    public function setVpsCpanelDesc($vps_cpanel_desc)
    {
        $this->vps_cpanel_desc = $vps_cpanel_desc;
    }

    public function getVpsCpanelPrice()
    {
        return $this->vps_cpanel_price;
    }

    public function setVpsCpanelPrice($vps_cpanel_price)
    {
        $this->vps_cpanel_price = $vps_cpanel_price;
    }


    public function getCpcpanelconn()
    {
        return $this->cpcpanelconn;
    }


    public function getVpshosting()
    {
        return $this->vpshosting;
    }
}
