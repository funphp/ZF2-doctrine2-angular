<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oauth_token")
 * @ORM\Entity(repositoryClass="Api\Repositories\OauthTokenRepository")
 */
class OauthToken
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
     * @ORM\Column(name="token", type="string", length=100)
     */
    private $token;
    
    /**
     * @var string $title
     *
     * @ORM\Column(name="tokenSecret", type="string", length=100)
     */
    private $tokenSecret;
    
    /**
     * @var string $title
     *
     * @ORM\Column(name="expiry", type="date")
     */
    private $expiry;
    
    /**
     * @var string $title
     *
     * @ORM\Column(name="type", type="string", length=10)
     */
    private $type;
    
    /**
     * @var string $title
     *
     * @ORM\Column(name="accesses", type="string", length=100)
     */
    private $accesses;
    
    /**
     * @var string $createdAt
     *
     * @ORM\Column(name="createdAt", type="date")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="Api\Entity\User", inversedBy="oauthTokens")
     * @ORM\JoinColumn(referencedColumnName="id")
     **/
    private $owner;
    
    /**
     * @ORM\ManyToOne(targetEntity="Api\Entity\OauthKey", inversedBy="oauthTokens")
     * @ORM\JoinColumn(referencedColumnName="id")
     **/
    private $oauthKey;


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
     * Set token
     *
     * @param string $token
     * @return OauthToken
     */
    public function setToken($token)
    {
        $this->token = $token;
    
        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set tokenSecret
     *
     * @param string $tokenSecret
     * @return OauthToken
     */
    public function setTokenSecret($tokenSecret)
    {
        $this->tokenSecret = $tokenSecret;
    
        return $this;
    }

    /**
     * Get tokenSecret
     *
     * @return string 
     */
    public function getTokenSecret()
    {
        return $this->tokenSecret;
    }

    /**
     * Set expiry
     *
     * @param \DateTime $expiry
     * @return OauthToken
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
     * Set type
     *
     * @param string $type
     * @return OauthToken
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set accesses
     *
     * @param string $accesses
     * @return OauthToken
     */
    public function setAccesses($accesses)
    {
        $this->accesses = $accesses;
    
        return $this;
    }

    /**
     * Get accesses
     *
     * @return string 
     */
    public function getAccesses()
    {
        return $this->accesses;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return OauthToken
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
     * Set owner
     *
     * @param Api\Entity\User $owner
     * @return OauthToken
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

    /**
     * Set oauthKey
     *
     * @param Api\Entity\OauthKey $oauthKey
     * @return OauthToken
     */
    public function setOauthKey(\Api\Entity\OauthKey $oauthKey = null)
    {
        $this->oauthKey = $oauthKey;
    
        return $this;
    }

    /**
     * Get oauthKey
     *
     * @return Api\Entity\OauthKey 
     */
    public function getOauthKey()
    {
        return $this->oauthKey;
    }
}