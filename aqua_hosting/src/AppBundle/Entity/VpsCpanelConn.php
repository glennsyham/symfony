<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="vps_cpanel_conn")
 * @UniqueEntity(
 *     fields={"vpscpanel_id","vpsos_id"},
 *     message="Cpanel already exist",
 *     errorPath="members")
 */
class VpsCpanelConn
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $vpscpanel_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $vpsos_id;

    /**
     * @Assert\NotBlank(message="Please choose a Cpanel")
     * @ORM\ManyToOne(targetEntity="VpsCpanel",inversedBy="cpcpanelconn")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vpscpanel;

    /**
     * @ORM\ManyToOne(targetEntity="VpsOs",inversedBy="oscpanelconn")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vpsos;

    public function getId()
    {
        return $this->id;
    }

    public function getVpsos()
    {
        return $this->vpsos;
    }

    public function setVpsos(VpsOs $vpsos)
    {
        $this->vpsos = $vpsos;
    }

    public function getVpscpanel()
    {
        return $this->vpscpanel;
    }

    public function setVpscpanel(VpsCpanel $vpscpanel)
    {
        $this->vpscpanel = $vpscpanel;
    }

    public function getVpscpanelId()
    {
        return $this->vpscpanel_id;
    }


    public function setVpscpanelId($vpscpanel_id)
    {
        $this->vpscpanel_id = $vpscpanel_id;
    }


    public function getVpsosId()
    {
        return $this->vpsos_id;
    }

    public function setVpsosId($vpsos_id)
    {
        $this->vpsos_id = $vpsos_id;
    }
}
