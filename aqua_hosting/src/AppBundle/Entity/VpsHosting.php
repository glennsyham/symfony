<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="vps_hosting")
 */
class VpsHosting
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Range(min="1",minMessage="Processors cannot be lower than 1")
     * @Assert\Range(max="8",maxMessage="Processors cannot be higher than 8")
     * @ORM\Column(type="integer")
     */
    private $cpu;

    /**
     * @Assert\NotBlank()
     * @Assert\Range(min="1",minMessage="Memory cannot be lower than 1Gb")
     * @Assert\Range(max="32",maxMessage="Memory cannot be higher than 32Gb")
     * @ORM\Column(type="integer")
     */
    private $ram;

    /**
     * @Assert\NotBlank()
     * @Assert\Range(min="1",maxMessage="Disk size cannot be lower than 50Gb")
     * @Assert\Range(max="16",maxMessage="Disk size cannot be higher than 800Gb")
     * @ORM\Column(type="integer")
     */
    private $hd;

    /**
     * @Assert\NotBlank()
     * @Assert\Range(min="1",min="Ip Address cannot be lower than 1")
     * @Assert\Range(max="24",maxMessage="Ip Address cannot be higher than 24")
     * @ORM\Column(type="integer")
     */
    private $ip_addresses;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $host_name;

    /**
     * @Assert\NotBlank()
     * @ORM\ManyToOne(targetEntity="VpsOs", inversedBy="vpshosting")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vpsos;

    /**
     * @ORM\ManyToOne(targetEntity="VpsCpanel", inversedBy="vpshosting")
     */
    private $vpscpanel;

    /**
     * @ORM\ManyToOne(targetEntity="VpsDatabase", inversedBy="vpshosting")
     */
    private $vpsdatabase;

    /**
     * @ORM\ManyToOne(targetEntity="RemoteBackup", inversedBy="vpshosting")
     */
    private $remotebackup;

    /**
     * @ORM\ManyToOne(targetEntity="Members", inversedBy="vpshosting")
     */
    private $members;

    public function __construct()
    {
        $this->vpshosting = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCpu()
    {
        return $this->cpu;
    }

    public function setCpu($cpu)
    {
        $this->cpu = $cpu;
    }

    public function getRam()
    {
        return $this->ram;
    }

    public function setRam($ram)
    {
        $this->ram = $ram;
    }

    public function getHd()
    {
        return $this->hd;
    }

    public function setHd($hd)
    {
        $this->hd = $hd;
    }

    public function getHostName()
    {
        return $this->host_name;
    }

    public function setHostName($host_name)
    {
        $this->host_name = $host_name;
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

    public function getVpsdatabase()
    {
        return $this->vpsdatabase;
    }

    public function setVpsdatabase(VpsDatabase $vpsdatabase)
    {
        $this->vpsdatabase = $vpsdatabase;
    }

    public function getRemotebackup()
    {
        return $this->remotebackup;
    }

    public function setRemotebackup(RemoteBackup $remotebackup)
    {
        $this->remotebackup = $remotebackup;
    }

    public function getIpAddresses()
    {
        return $this->ip_addresses;
    }

    public function setIpAddresses($ip_addresses)
    {
        $this->ip_addresses = $ip_addresses;
    }

    public function getMembers()
    {
        return $this->members;
    }

    public function setMembers($members)
    {
        $this->members = $members;
    }
}
