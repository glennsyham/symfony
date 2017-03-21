<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vps_database")
 */
class VpsDatabase
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
    private $platform;

    /**
     * @ORM\Column(type="string")
     */
    private $desc;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $sort_order;

    /**
     * @ORM\OneToMany(targetEntity="VpsHosting",mappedBy="vpshosting")
     */
    private $vpshosting;

    public function getId()
    {
        return $this->id;
    }

    public function getPlatform()
    {
        return $this->platform;
    }

    public function setPlatform($platform)
    {
        $this->platform = $platform;
    }

    public function getDesc()
    {
        return $this->desc;
    }

    public function setDesc($desc)
    {
        $this->desc = $desc;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getSortOrder()
    {
        return $this->sort_order;
    }

    public function setSortOrder($sort_order)
    {
        $this->sort_order = $sort_order;
    }

    public function getVpshosting()
    {
        return $this->vpshosting;
    }
}
