<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="goals")
 * @ORM\Entity(repositoryClass="Api\Repositories\GoalRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Goal
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string $status
     *
     * @ORM\Column(name="status", type="smallint")
     */
    private $status;

    /**
     * @var string $reward
     *
     * @ORM\Column(name="reward", type="string", length=255)
     */
    private $reward;

    /**
     * @var string $progress
     *
     * @ORM\Column(name="progress", type="float")
     */
    private $progress;

    /**
     * @var string $access
     *
     * @ORM\Column(name="access", type="smallint")
     */
    private $access;

    /**
     * @var string $expiry
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
     * @var string $updatedAt
     *
     * @ORM\Column(name="updatedAt", type="date")
     */
    private $updatedAt;
    
    /**
     * @ORM\OneToMany(targetEntity="Api\Entity\Task", mappedBy="goal")
     **/
    private $tasks;
    
    /**
     * @ORM\OneToMany(targetEntity="Api\Entity\GoalAttachment", mappedBy="goal")
     **/
    private $attachments;
    
    /**
     * @ORM\OneToMany(targetEntity="Api\Entity\GoalComment", mappedBy="goal")
     **/
    private $comments;
    
    /**
     * @ORM\ManyToOne(targetEntity="Api\Entity\User", inversedBy="myGoals")
     * @ORM\JoinColumn(referencedColumnName="id")
     **/
    private $owner;
    
    /**
     * @ORM\ManyToOne(targetEntity="Api\Entity\Assignee", inversedBy="goals")
     * @ORM\JoinColumn(referencedColumnName="id")
     **/
    private $assignee;
    
    /**
     * @ORM\ManyToOne(targetEntity="Api\Entity\User", inversedBy="groupAssignGoals")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=TRUE)
     **/
    private $groupAssignee;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tasks = new \Doctrine\Common\Collections\ArrayCollection();
        $this->attachments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return Goal
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Goal
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
     * Set reward
     *
     * @param string $reward
     * @return Goal
     */
    public function setReward($reward)
    {
        $this->reward = $reward;
    
        return $this;
    }

    /**
     * Get reward
     *
     * @return string 
     */
    public function getReward()
    {
        return $this->reward;
    }

    /**
     * Set progress
     *
     * @param float $progress
     * @return Goal
     */
    public function setProgress($progress)
    {
        $this->progress = $progress;
    
        return $this;
    }

    /**
     * Get progress
     *
     * @return float 
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * Set access
     *
     * @param integer $access
     * @return Goal
     */
    public function setAccess($access)
    {
        $this->access = $access;
    
        return $this;
    }

    /**
     * Get access
     *
     * @return integer 
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * Set expiry
     *
     * @param \DateTime $expiry
     * @return Goal
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
     * @return Goal
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
     * @return Goal
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
     * Add tasks
     *
     * @param Api\Entity\Task $tasks
     * @return Goal
     */
    public function addTask(\Api\Entity\Task $tasks)
    {
        $this->tasks[] = $tasks;
    
        return $this;
    }

    /**
     * Remove tasks
     *
     * @param Api\Entity\Task $tasks
     */
    public function removeTask(\Api\Entity\Task $tasks)
    {
        $this->tasks->removeElement($tasks);
    }

    /**
     * Get tasks
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * Add attachments
     *
     * @param Api\Entity\GoalAttachment $attachments
     * @return Goal
     */
    public function addAttachment(\Api\Entity\GoalAttachment $attachments)
    {
        $this->attachments[] = $attachments;
    
        return $this;
    }

    /**
     * Remove attachments
     *
     * @param Api\Entity\GoalAttachment $attachments
     */
    public function removeAttachment(\Api\Entity\GoalAttachment $attachments)
    {
        $this->attachments->removeElement($attachments);
    }

    /**
     * Get attachments
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * Add comments
     *
     * @param Api\Entity\GoalComment $comments
     * @return Goal
     */
    public function addComment(\Api\Entity\GoalComment $comments)
    {
        $this->comments[] = $comments;
    
        return $this;
    }

    /**
     * Remove comments
     *
     * @param Api\Entity\GoalComment $comments
     */
    public function removeComment(\Api\Entity\GoalComment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set owner
     *
     * @param Api\Entity\User $owner
     * @return Goal
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
     * Set assignee
     *
     * @param Api\Entity\Assignee $assignee
     * @return Goal
     */
    public function setAssignee(\Api\Entity\Assignee $assignee = null)
    {
        $this->assignee = $assignee;
    
        return $this;
    }

    /**
     * Get assignee
     *
     * @return Api\Entity\Assignee 
     */
    public function getAssignee()
    {
        return $this->assignee;
    }
    
    /** @ORM\PrePersist 
     */
    public function doStuffOnPrePersist()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * Set groupAssignee
     *
     * @param Api\Entity\User $groupAssignee
     * @return Goal
     */
    public function setGroupAssignee(\Api\Entity\User $groupAssignee = null)
    {
        $this->groupAssignee = $groupAssignee;
    
        return $this;
    }

    /**
     * Get groupAssignee
     *
     * @return Api\Entity\User 
     */
    public function getGroupAssignee()
    {
        return $this->groupAssignee;
    }
}