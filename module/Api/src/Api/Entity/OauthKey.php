<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oauth_keys")
 * @ORM\Entity(repositoryClass="Api\Repositories\OauthKeyRepository")
 */
class OauthKey
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
     * @ORM\Column(name="consumerKey", type="string", length=100)
     */
    private $consumerKey;
    
    /**
     * @var string $title
     *
     * @ORM\Column(name="consumerSecret", type="string", length=100)
     */
    private $consumerSecret;
    
    /**
     * @var string $title
     *
     * @ORM\Column(name="expiry", type="date")
     */
    private $expiry;
    
    /**
     * @var string $createdAt
     *
     * @ORM\Column(name="createdAt", type="date")
     */
    private $createdAt;
    
    /**
     * @ORM\OneToMany(targetEntity="Api\Entity\OauthToken", mappedBy="oauthKey")
     **/
    private $oauthTokens;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->oauthTokens = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set consumerKey
     *
     * @param string $consumerKey
     * @return OauthKey
     */
    public function setConsumerKey($consumerKey)
    {
        $this->consumerKey = $consumerKey;
    
        return $this;
    }

    /**
     * Get consumerKey
     *
     * @return string 
     */
    public function getConsumerKey()
    {
        return $this->consumerKey;
    }

    /**
     * Set consumerSecret
     *
     * @param string $consumerSecret
     * @return OauthKey
     */
    public function setConsumerSecret($consumerSecret)
    {
        $this->consumerSecret = $consumerSecret;
    
        return $this;
    }

    /**
     * Get consumerSecret
     *
     * @return string 
     */
    public function getConsumerSecret()
    {
        return $this->consumerSecret;
    }

    /**
     * Set expiry
     *
     * @param \DateTime $expiry
     * @return OauthKey
     */
    public function setExpiry($expiry)
    {
        $this->expiry = $expiry;
    
        return $this;
    }

    /**
     * Get expiry
     *
     * @return \DateTime 
     */
    public function getExpiry()
    {
        return $this->expiry;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return OauthKey
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
     * Add oauthTokens
     *
     * @param Api\Entity\OauthToken $oauthTokens
     * @return OauthKey
     */
    public function addOauthToken(\Api\Entity\OauthToken $oauthTokens)
    {
        $this->oauthTokens[] = $oauthTokens;
    
        return $this;
    }

    /**
     * Remove oauthTokens
     *
     * @param Api\Entity\OauthToken $oauthTokens
     */
    public function removeOauthToken(\Api\Entity\OauthToken $oauthTokens)
    {
        $this->oauthTokens->removeElement($oauthTokens);
    }

    /**
     * Get oauthTokens
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getOauthTokens()
    {
        return $this->oauthTokens;
    }
}