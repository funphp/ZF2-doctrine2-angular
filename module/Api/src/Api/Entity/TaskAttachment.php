<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="task_attachments")
 * @ORM\Entity(repositoryClass="Api\Repositories\TaskAttachmentRepository")
 */
class TaskAttachment
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
     * @ORM\Column(name="name", type="string", length=255)
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
     * @ORM\ManyToOne(targetEntity="Api\Entity\User", inversedBy="taskAttachments")
     * @ORM\JoinColumn(referencedColumnName="id")
     **/
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="Api\Entity\Task", inversedBy="attachments")
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
     * Set name
     *
     * @param string $name
     * @return TaskAttachment
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
     * @return TaskAttachment
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
     * @return TaskAttachment
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
     * @return TaskAttachment
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
     * @return TaskAttachment
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