<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="members")
 * @UniqueEntity(fields={"email"},message="You already have an existing account.")
 */
class Members implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * @ORM\Column(type="string",unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="json_array")
     */
    private $roles = [];

    /**
     * @Assert\NotBlank(groups={"Registration"})
     */
    private $plainPassword;

    /**
     * @ORM\OneToMany(targetEntity="VpsHosting",mappedBy="vpshosting")
     */
    private $vpshosting;

    /**
     * @ORM\OneToMany(targetEntity="MembersDetail",
     *     mappedBy="members",
     *     fetch="EXTRA_LAZY",
     *     orphanRemoval=true,
     *     cascade={"persist"}
     * )
     * @Assert\Valid()
     */
    private $membersdetail;

    public function __construct()
    {
        $this->vpshosting = new ArrayCollection();
        $this->membersdetail = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function getRoles()
    {
        $roles = $this->roles;
        if (!in_array('ROLE_USER', $this->roles)) {
            $roles[] = 'ROLE_USER';
        }
        return $roles;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        $this->password = null;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return ArrayCollection|Vpshosting[]
     */
    public function getVpshosting()
    {
        return $this->vpshosting;
    }

    /**
     * @return ArrayCollection|MembersDetail[]
     */
    public function getMembersdetail()
    {
        return $this->membersdetail;
    }

    public function addMembersdetail(MembersDetail $membersDetail)
    {
        if ($this->membersdetail->contains($membersDetail)) {
            return;
        }

        $this->membersdetail[] = $membersDetail;
        // needed to update the owning side of the relationship!
        $membersDetail->setMembers($this);
    }

    public function removeMembersdetail(MembersDetail $membersDetail)
    {
        if ($this->membersdetail->contains($membersDetail)) {
            return;
        }

        $this->membersdetail->removeElement($membersDetail);
        // needed to update the owning side of the relationship!
        $membersDetail->setMembers(null);
    }
}
