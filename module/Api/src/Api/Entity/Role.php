<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="roles")
 * @ORM\Entity(repositoryClass="Api\Repositories\RoleRepository")
 */
class Role
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
     * @ORM\OneToMany(targetEntity="Api\Entity\user", mappedBy="role")
     **/
    private $users;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Role
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
     * @return Role
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
     * @return Role
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
     * Add users
     *
     * @param Api\Entity\user $users
     * @return Role
     */
    public function addUser(\Api\Entity\user $users)
    {
        $this->users[] = $users;
    
        return $this;
    }

    /**
     * Remove users
     *
     * @param Api\Entity\user $users
     */
    public function removeUser(\Api\Entity\user $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}