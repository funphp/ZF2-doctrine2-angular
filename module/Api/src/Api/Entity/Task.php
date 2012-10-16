<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="tasks")
 * @ORM\Entity(repositoryClass="Api\Repositories\TaskRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Task
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
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;

    /**
     * @var float $progress
     *
     * @ORM\Column(name="progress", type="float")
     */
    private $progress;

    /**
     * @var integer $priority
     *
     * @ORM\Column(name="priority", type="integer")
     */
    private $priority;

    /**
     * @var smallint $status
     *
     * @ORM\Column(name="status", type="smallint")
     */
    private $status;

    /**
     * @var date $expiry
     *
     * @ORM\Column(name="expiry", type="date")
     */
    private $expiry;

    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var datetime $updatedAt
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="Api\Entity\Goal", inversedBy="tasks")
     **/
    private $goal;
    
    /**
     * @ORM\OneToMany(targetEntity="Api\Entity\TaskComment", mappedBy="task")
     **/
    private $comments;
    
    /**
     * @ORM\OneToMany(targetEntity="Api\Entity\TaskAttachment", mappedBy="task")
     **/
    private $attachments;
    
    /**
     * @ORM\ManyToOne(targetEntity="Api\Entity\Assignee", inversedBy="tasks")
     * @ORM\JoinColumn(referencedColumnName="id")
     **/
    private $assignee;
    
    /**
     * @ORM\ManyToOne(targetEntity="Api\Entity\User", inversedBy="groupAssignTasks")
     * @ORM\JoinColumn(referencedColumnName="id", nullable=TRUE)
     **/
    private $groupAssignee;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->attachments = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Task
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
     * Set progress
     *
     * @param float $progress
     * @return Task
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
     * Set priority
     *
     * @param integer $priority
     * @return Task
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    
        return $this;
    }

    /**
     * Get priority
     *
     * @return integer 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Task
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
     * Set expiry
     *
     * @param \DateTime $expiry
     * @return Task
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
     * @return Task
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
     * @return Task
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
     * Set goal
     *
     * @param Api\Entity\Goal $goal
     * @return Task
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

    /**
     * Add comments
     *
     * @param Api\Entity\TaskComment $comments
     * @return Task
     */
    public function addComment(\Api\Entity\TaskComment $comments)
    {
        $this->comments[] = $comments;
    
        return $this;
    }

    /**
     * Remove comments
     *
     * @param Api\Entity\TaskComment $comments
     */
    public function removeComment(\Api\Entity\TaskComment $comments)
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
     * Add attachments
     *
     * @param Api\Entity\TaskAttachment $attachments
     * @return Task
     */
    public function addAttachment(\Api\Entity\TaskAttachment $attachments)
    {
        $this->attachments[] = $attachments;
    
        return $this;
    }

    /**
     * Remove attachments
     *
     * @param Api\Entity\TaskAttachment $attachments
     */
    public function removeAttachment(\Api\Entity\TaskAttachment $attachments)
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

    /** @ORM\PrePersist 
     */
    public function doStuffOnPrePersist()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * Set assignee
     *
     * @param Api\Entity\Assignee $assignee
     * @return Task
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

    /**
     * Set groupAssignee
     *
     * @param Api\Entity\User $groupAssignee
     * @return Task
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