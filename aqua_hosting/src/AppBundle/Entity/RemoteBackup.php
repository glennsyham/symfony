<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="remote_backup")
 */
class RemoteBackup
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
    private $r_name;

    /**
     * @ORM\Column(type="string")
     */
    private $description;

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

    public function getRName()
    {
        return $this->r_name;
    }

    public function setRName($r_name)
    {
        $this->r_name = $r_name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
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
