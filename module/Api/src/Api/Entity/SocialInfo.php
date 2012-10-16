<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="social_info")
 * @ORM\Entity(repositoryClass="Api\Repositories\SocialInfoRepository")
 */
class SocialInfo
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
     * @var string $uId
     *
     * @ORM\Column(name="uId", type="string", length=100)
     */
    private $uId;
    
    /**
     * @var string $access
     *
     * @ORM\Column(name="access", type="string", length=100)
     */
    private $access;
    
    /**
     * @var string $secret
     *
     * @ORM\Column(name="secret", type="string", length=100)
     */
    private $secret;
    
    /**
     * @ORM\ManyToOne(targetEntity="Api\Entity\User", inversedBy="socials")
     * @ORM\JoinColumn(referencedColumnName="id")
     **/
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="Api\Entity\SocialProvider", inversedBy="socials")
     * @ORM\JoinColumn(referencedColumnName="id")
     **/
    private $provider;
    
    

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
     * Set uId
     *
     * @param string $uId
     * @return SocialInfo
     */
    public function setUId($uId)
    {
        $this->uId = $uId;
    
        return $this;
    }

    /**
     * Get uId
     *
     * @return string 
     */
    public function getUId()
    {
        return $this->uId;
    }

    /**
     * Set access
     *
     * @param string $access
     * @return SocialInfo
     */
    public function setAccess($access)
    {
        $this->access = $access;
    
        return $this;
    }

    /**
     * Get access
     *
     * @return string 
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * Set secret
     *
     * @param string $secret
     * @return SocialInfo
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    
        return $this;
    }

    /**
     * Get secret
     *
     * @return string 
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * Set user
     *
     * @param Api\Entity\User $user
     * @return SocialInfo
     */
    public function setUser(\Api\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return Api\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set provider
     *
     * @param Api\Entity\SocialProvider $provider
     * @return SocialInfo
     */
    public function setProvider(\Api\Entity\SocialProvider $provider = null)
    {
        $this->provider = $provider;
    
        return $this;
    }

    /**
     * Get provider
     *
     * @return Api\Entity\SocialProvider 
     */
    public function getProvider()
    {
        return $this->provider;
    }
}