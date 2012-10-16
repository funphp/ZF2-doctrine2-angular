<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="social_providers")
 * @ORM\Entity(repositoryClass="Api\Repositories\SocialProviderRepository")
 */
class SocialProvider
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
     * @ORM\OneToMany(targetEntity="Api\Entity\SocialInfo", mappedBy="provider")
     **/
    private $socials;
    

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->socials = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return SocialProvider
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
     * Add socials
     *
     * @param Api\Entity\SocialInfo $socials
     * @return SocialProvider
     */
    public function addSocial(\Api\Entity\SocialInfo $socials)
    {
        $this->socials[] = $socials;
    
        return $this;
    }

    /**
     * Remove socials
     *
     * @param Api\Entity\SocialInfo $socials
     */
    public function removeSocial(\Api\Entity\SocialInfo $socials)
    {
        $this->socials->removeElement($socials);
    }

    /**
     * Get socials
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSocials()
    {
        return $this->socials;
    }
}