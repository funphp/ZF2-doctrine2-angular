<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="goal_comments")
 * @ORM\Entity(repositoryClass="Api\Repositories\GoalCommentRepository")
 * @ORM\HasLifecycleCallbacks
 */
class GoalComment
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
     * @var string $comment
     *
     * @ORM\Column(name="comment", type="string", length=255)
     */
    private $comment;

    /**
     * @var smallint $status
     *
     * @ORM\Column(name="status", type="smallint")
     */
    private $status;

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="Api\Entity\User", inversedBy="comments")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="Api\Entity\Goal", inversedBy="comments")
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
     * Set comment
     *
     * @param string $comment
     * @return GoalComment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    
        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return GoalComment
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return GoalComment
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
     * Set user
     *
     * @param Api\Entity\User $user
     * @return GoalComment
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
     * @return GoalComment
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
    
    /** @ORM\PrePersist 
     */
    public function doStuffOnPrePersist()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }
}