<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="task_comments")
 * @ORM\Entity(repositoryClass="Api\Repositories\TaskCommentRepository")
 */
class TaskComment
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
     * @ORM\ManyToOne(targetEntity="Api\Entity\User", inversedBy="taskComments")
     * @ORM\JoinColumn(referencedColumnName="id")
     **/
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="Api\Entity\Task", inversedBy="comments")
     * @ORM\JoinColumn(referencedColumnName="id")
     **/
    private $task;


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
     * @return TaskComment
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
     * @return TaskComment
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
     * @return TaskComment
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
     * @return TaskComment
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
     * Set task
     *
     * @param Api\Entity\Task $task
     * @return TaskComment
     */
    public function setTask(\Api\Entity\Task $task = null)
    {
        $this->task = $task;
    
        return $this;
    }

    /**
     * Get task
     *
     * @return Api\Entity\Task 
     */
    public function getTask()
    {
        return $this->task;
    }
}