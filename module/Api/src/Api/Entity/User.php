<?php

namespace Api\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="Api\Repositories\UserRepository")
 */
class User extends Assignee
{
    /**
     * @ORM\ManyToMany(targetEntity="Api\Entity\Group", mappedBy="members")
     */
    private $groups;
    
    /**
     * @ORM\OneToMany(targetEntity="Api\Entity\Group", mappedBy="owner")
     **/
    private $myGroups;
    
    /**
     * @ORM\OneToMany(targetEntity="Api\Entity\SocialInfo", mappedBy="user")
     **/
    private $socials;
    
    /**
     * @ORM\OneToMany(targetEntity="Api\Entity\Goal", mappedBy="owner")
     **/
    private $myGoals;
    
    /**
     * @ORM\OneToMany(targetEntity="Api\Entity\GoalAttachment", mappedBy="user")
     **/
    private $attachments;
    
    /**
     * @ORM\OneToMany(targetEntity="Api\Entity\GoalComment", mappedBy="user")
     **/
    private $comments;
    
    /**
     * @ORM\OneToMany(targetEntity="Api\Entity\TaskAttachment", mappedBy="user")
     **/
    private $taskAttachments;
    
    /**
     * @ORM\OneToMany(targetEntity="Api\Entity\TaskComment", mappedBy="user")
     **/
    private $taskComments;
    
    /**
     * @ORM\OneToMany(targetEntity="Api\Entity\OauthToken", mappedBy="owner")
     **/
    private $oauthTokens;
    
    /**
     * @ORM\OneToOne(targetEntity="Api\Entity\SocialInfo", mappedBy="user")
     */
    private $socialInfo;
    
    /**
     * @ORM\ManyToOne(targetEntity="Api\Entity\Role", inversedBy="users")
     * @ORM\JoinColumn(referencedColumnName="id")
     **/
    private $role;

    /**
     * @ORM\OneToMany(targetEntity="Api\Entity\Goal", mappedBy="groupAssignee")
     **/
    private $groupAssignGoals;
    
    /**
     * @ORM\OneToMany(targetEntity="Api\Entity\Task", mappedBy="groupAssignee")
     **/
    private $groupAssignTasks;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
        $this->myGroups = new \Doctrine\Common\Collections\ArrayCollection();
        $this->socials = new \Doctrine\Common\Collections\ArrayCollection();
        $this->myGoals = new \Doctrine\Common\Collections\ArrayCollection();
        $this->receiveGoal = new \Doctrine\Common\Collections\ArrayCollection();
        $this->attachments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->taskAttachments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->taskComments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->receiveTask = new \Doctrine\Common\Collections\ArrayCollection();
        $this->oauthTokens = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    
    /**
     * Add groups
     *
     * @param Api\Entity\Group $groups
     * @return User
     */
    public function addGroup(\Api\Entity\Group $groups)
    {
        $this->groups[] = $groups;
    
        return $this;
    }

    /**
     * Remove groups
     *
     * @param Api\Entity\Group $groups
     */
    public function removeGroup(\Api\Entity\Group $groups)
    {
        $this->groups->removeElement($groups);
    }

    /**
     * Get groups
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * Add myGroups
     *
     * @param Api\Entity\Group $myGroups
     * @return User
     */
    public function addMyGroup(\Api\Entity\Group $myGroups)
    {
        $this->myGroups[] = $myGroups;
    
        return $this;
    }

    /**
     * Remove myGroups
     *
     * @param Api\Entity\Group $myGroups
     */
    public function removeMyGroup(\Api\Entity\Group $myGroups)
    {
        $this->myGroups->removeElement($myGroups);
    }

    /**
     * Get myGroups
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMyGroups()
    {
        return $this->myGroups;
    }

    /**
     * Add socials
     *
     * @param Api\Entity\SocialInfo $socials
     * @return User
     */
    public function addSocial(\Api\Entity\SocialInfo $socials)
    {
        $this->socials[] = $socials;
    
        return $this;
    }

    /**
     * Remove socials
     *
     * @param Api\Entity\SocialInfo $socials
     */
    public function removeSocial(\Api\Entity\SocialInfo $socials)
    {
        $this->socials->removeElement($socials);
    }

    /**
     * Get socials
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSocials()
    {
        return $this->socials;
    }

    /**
     * Add myGoals
     *
     * @param Api\Entity\Goal $myGoals
     * @return User
     */
    public function addMyGoal(\Api\Entity\Goal $myGoals)
    {
        $this->myGoals[] = $myGoals;
    
        return $this;
    }

    /**
     * Remove myGoals
     *
     * @param Api\Entity\Goal $myGoals
     */
    public function removeMyGoal(\Api\Entity\Goal $myGoals)
    {
        $this->myGoals->removeElement($myGoals);
    }

    /**
     * Get myGoals
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMyGoals()
    {
        return $this->myGoals;
    }

    /**
     * Add attachments
     *
     * @param Api\Entity\GoalAttachment $attachments
     * @return User
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
     * @return User
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
     * Add taskAttachments
     *
     * @param Api\Entity\TaskAttachment $taskAttachments
     * @return User
     */
    public function addTaskAttachment(\Api\Entity\TaskAttachment $taskAttachments)
    {
        $this->taskAttachments[] = $taskAttachments;
    
        return $this;
    }

    /**
     * Remove taskAttachments
     *
     * @param Api\Entity\TaskAttachment $taskAttachments
     */
    public function removeTaskAttachment(\Api\Entity\TaskAttachment $taskAttachments)
    {
        $this->taskAttachments->removeElement($taskAttachments);
    }

    /**
     * Get taskAttachments
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTaskAttachments()
    {
        return $this->taskAttachments;
    }

    /**
     * Add taskComments
     *
     * @param Api\Entity\TaskComment $taskComments
     * @return User
     */
    public function addTaskComment(\Api\Entity\TaskComment $taskComments)
    {
        $this->taskComments[] = $taskComments;
    
        return $this;
    }

    /**
     * Remove taskComments
     *
     * @param Api\Entity\TaskComment $taskComments
     */
    public function removeTaskComment(\Api\Entity\TaskComment $taskComments)
    {
        $this->taskComments->removeElement($taskComments);
    }

    /**
     * Get taskComments
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTaskComments()
    {
        return $this->taskComments;
    }

    /**
     * Add oauthTokens
     *
     * @param Api\Entity\OauthToken $oauthTokens
     * @return User
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

    /**
     * Set socialInfo
     *
     * @param Api\Entity\SocialInfo $socialInfo
     * @return User
     */
    public function setSocialInfo(\Api\Entity\SocialInfo $socialInfo = null)
    {
        $this->socialInfo = $socialInfo;
    
        return $this;
    }

    /**
     * Get socialInfo
     *
     * @return Api\Entity\SocialInfo 
     */
    public function getSocialInfo()
    {
        return $this->socialInfo;
    }

    /**
     * Set role
     *
     * @param Api\Entity\Role $role
     * @return User
     */
    public function setRole(\Api\Entity\Role $role = null)
    {
        $this->role = $role;
    
        return $this;
    }

    /**
     * Get role
     *
     * @return Api\Entity\Role 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Add groupAssignGoals
     *
     * @param Api\Entity\Goal $groupAssignGoals
     * @return User
     */
    public function addGroupAssignGoal(\Api\Entity\Goal $groupAssignGoals)
    {
        $this->groupAssignGoals[] = $groupAssignGoals;
    
        return $this;
    }

    /**
     * Remove groupAssignGoals
     *
     * @param Api\Entity\Goal $groupAssignGoals
     */
    public function removeGroupAssignGoal(\Api\Entity\Goal $groupAssignGoals)
    {
        $this->groupAssignGoals->removeElement($groupAssignGoals);
    }

    /**
     * Get groupAssignGoals
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getGroupAssignGoals()
    {
        return $this->groupAssignGoals;
    }

    /**
     * Add groupAssignTasks
     *
     * @param Api\Entity\Task $groupAssignTasks
     * @return User
     */
    public function addGroupAssignTask(\Api\Entity\Task $groupAssignTasks)
    {
        $this->groupAssignTasks[] = $groupAssignTasks;
    
        return $this;
    }

    /**
     * Remove groupAssignTasks
     *
     * @param Api\Entity\Task $groupAssignTasks
     */
    public function removeGroupAssignTask(\Api\Entity\Task $groupAssignTasks)
    {
        $this->groupAssignTasks->removeElement($groupAssignTasks);
    }

    /**
     * Get groupAssignTasks
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getGroupAssignTasks()
    {
        return $this->groupAssignTasks;
    }
}