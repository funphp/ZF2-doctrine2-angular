<?php

namespace Api\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="assignee")
 * @ORM\Entity(repositoryClass="Api\Repositories\AssigneeRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"group" = "Group", "user" = "User"})
 */
class Assignee
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
     * @ORM\OneToMany(targetEntity="Api\Entity\Goal", mappedBy="assignee")
     **/
    private $goals;
    
    /**
     * @ORM\OneToMany(targetEntity="Api\Entity\Task", mappedBy="assignee")
     **/
    private $tasks;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->goals = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add goals
     *
     * @param Api\Entity\Goal $goals
     * @return Assignee
     */
    public function addGoal(\Api\Entity\Goal $goals)
    {
        $this->goals[] = $goals;
    
        return $this;
    }

    /**
     * Remove goals
     *
     * @param Api\Entity\Goal $goals
     */
    public function removeGoal(\Api\Entity\Goal $goals)
    {
        $this->goals->removeElement($goals);
    }

    /**
     * Get goals
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getGoals()
    {
        return $this->goals;
    }

    /**
     * Add tasks
     *
     * @param Api\Entity\Task $tasks
     * @return Assignee
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
}