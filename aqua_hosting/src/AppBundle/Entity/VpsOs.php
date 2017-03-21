<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Respository\VpsOsRespository")
 * @ORM\Table(name="vps_os")
 */
class VpsOs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="integer")
     */
    private $server_id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="integer")
     */
    private $platform_id;

    /**
     * @Assert\NotBlank()
     * @Assert\Range(min="1",minMessage="Please use higher than 0")
     * @ORM\Column(type="integer")
     */
    private $sort_order;

    /**
     * @ORM\OneToMany(targetEntity="VpsCpanelConn", mappedBy="vpsos")
     * @ORM\OrderBy({"id"="ASC"})
     */
    private $oscpanelconn;

    /**
     * @ORM\OneToMany(targetEntity="VpsHosting",mappedBy="vpshosting")
     */
    private $vpshosting;

    public function __construct()
    {
        $this->oscpanelconn = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getServerId()
    {
        return $this->server_id;
    }

    /**
     * @param mixed $server_id
     */
    public function setServerId($server_id)
    {
        $this->server_id = $server_id;
    }

    /**
     * @return mixed
     */
    public function getPlatformId()
    {
        return $this->platform_id;
    }

    /**
     * @param mixed $platform_id
     */
    public function setPlatformId($platform_id)
    {
        $this->platform_id = $platform_id;
    }

    /**
     * @return mixed
     */
    public function getSortOrder()
    {
        return $this->sort_order;
    }

    /**
     * @param mixed $sort_order
     */
    public function setSortOrder($sort_order)
    {
        $this->sort_order = $sort_order;
    }

    /**
     * @return VpsCpanelConn
     */
    public function getOscpanelconn()
    {
        return $this->oscpanelconn;
    }

    public function getVpshosting()
    {
        return $this->vpshosting;
    }
}
