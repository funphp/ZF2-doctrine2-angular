<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="goal_attachments")
 * @ORM\Entity(repositoryClass="Api\Repositories\GoalAttachmentRepository")
 */
class GoalAttachment
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string $link
     *
     * @ORM\Column(name="link", type="string", length=100)
     */
    private $link;

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var datetime $updateAt
     *
     * @ORM\Column(name="updateAt", type="datetime")
     */
    private $updateAt;

    /**
     * @ORM\ManyToOne(targetEntity="Api\Entity\User", inversedBy="attachments")
     * @ORM\JoinColumn(referencedColumnName="id")
     **/
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="Api\Entity\Goal", inversedBy="attachments")
     * @ORM\JoinColumn(referencedColumnName="id")
     **/
    private $goal;



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
     * @return GoalAttachment
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
     * Set link
     *
     * @param string $link
     * @return GoalAttachment
     */
    public function setLink($link)
    {
        $this->link = $link;
    
        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return GoalAttachment
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
     * Set updateAt
     *
     * @param \DateTime $updateAt
     * @return GoalAttachment
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;
    
        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime 
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * Set user
     *
     * @param Api\Entity\User $user
     * @return GoalAttachment
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
     * Set goal
     *
     * @param Api\Entity\Goal $goal
     * @return GoalAttachment
     */
    public function setGoal(\Api\Entity\Goal $goal = null)
    {
        $this->goal = $goal;
    
        return $this;
    }

    /**
     * Get goal
     *
     * @return Api\Entity\Goal 
     */
    public function getGoal()
    {
        return $this->goal;
    }
}