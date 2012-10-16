<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;
use Api\Entity\Assignee;

/**
 * @ORM\Table(name="groups")
 * @ORM\Entity(repositoryClass="Api\Repositories\GroupRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Group extends Assignee
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string $title
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;
    
    /**
     * @var string $createdAt
     *
     * @ORM\Column(name="createdAt", type="date")
     */
    private $createdAt;

    /**
     * @var string $updatedAt
     *
     * @ORM\Column(name="updatedAt", type="date")
     */
    private $updatedAt;
    
    /**
     * @ORM\ManyToMany(targetEntity="Api\Entity\User", inversedBy="groups")
     **/
    private $members;
    
    /**
     * @ORM\ManyToOne(targetEntity="Api\Entity\User", inversedBy="myGroups")
     * @ORM\JoinColumn(referencedColumnName="id")
     **/
    private $owner;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->members = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Group
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Group
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Group
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add members
     *
     * @param Api\Entity\User $members
     * @return Group
     */
    public function addMember(\Api\Entity\User $members)
    {
        $this->members[] = $members;
    
        return $this;
    }

    /**
     * Remove members
     *
     * @param Api\Entity\User $members
     */
    public function removeMember(\Api\Entity\User $members)
    {
        $this->members->removeElement($members);
    }

    /**
     * Get members
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * Set owner
     *
     * @param Api\Entity\User $owner
     * @return Group
     */
    public function setOwner(\Api\Entity\User $owner = null)
    {
        $this->owner = $owner;
    
        return $this;
    }

    /**
     * Get owner
     *
     * @return Api\Entity\User 
     */
    public function getOwner()
    {
        return $this->owner;
    }
    
    
    /** @ORM\PrePersist 
     */
    public function doStuffOnPrePersist()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

}