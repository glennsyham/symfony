<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="members_detail")
 * @UniqueEntity(
 *     fields={"members"},
 *     message="Error on members",
 *     errorPath="members"
 * )
 */
class MembersDetail
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
    private $first_name;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $last_name;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $org_name;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $address1;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $address2;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $city;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $state;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $country;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $postal_code;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $phone;

    /**
     * @ORM\ManyToOne(targetEntity="Members", inversedBy="membersdetail")
     * @ORM\JoinColumn(nullable=false)
     */
    private $members;

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function getOrgName()
    {
        return $this->org_name;
    }

    public function setOrgName($org_name)
    {
        $this->org_name = $org_name;
    }

    public function getAddress1()
    {
        return $this->address1;
    }

    public function setAddress1($address1)
    {
        $this->address1 = $address1;
    }

    public function getAddress2()
    {
        return $this->address2;
    }

    public function setAddress2($address2)
    {
        $this->address2 = $address2;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getPostalCode()
    {
        return $this->postal_code;
    }

    public function setPostalCode($postal_code)
    {
        $this->postal_code = $postal_code;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getMembers()
    {
        return $this->members;
    }

    public function setMembers(Members $members)
    {
        $this->members = $members;
    }
}
