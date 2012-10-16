<?php
/*
 * This clss is for validate input form the user
 * over api protocol.
 */
namespace Api\Model;
class Validator
{
    private $_alphaValidator;
    private $_dateValidator;
    private $_digitValidator;
    public  $errorMessage;
    private $errorFound;
    private $em;


    public function __construct() {
        $this->_alphaValidator = new Zend_Validate_Alnum(array('allowWhiteSpace' => true));
        $this->_dateValidator = new Zend_Validate_Date(array('format'=>'MM-dd-yyyy'));
        $this->_digitValidator = new Zend_Validate_Digits();
        $this->errorMessage = array();
        $this->errorFound = false;
        $this->em = \Zend_Registry::get('doctrine')->getEntityManager();
    }

    public function validateGoal(array $data, $goalObj)
    {
    	
        if(!$data['title'] || !$this->_alphaValidator->isValid($data['title']) || !$this->_alphaValidator->isValid($data['reward'])){
            $this->errorMessage[] = 'Goal title or reward should be in corrent format';
            $this->errorFound = true;
        }

        if(!$goalObj->getId() && $this->_isGoalWithTitleExist($data['title'])){
            $this->errorMessage[] = 'Goal name already exist';
            $this->errorFound = true;
        }

        $assignee = $this->validAssignee($data['assignee'], $goalObj->getOwner()->getId());
        if(!$this->_digitValidator->isValid($data['assignee']) || !$assignee){
            $this->errorMessage[] = 'Assignee is not valid';
            $this->errorFound = true;
        }

        if($this->errorFound){
            return false;
        }

        if(!$data['expiry'] || !$this->_dateValidator->isValid($data['expiry'])){
            $data['expiry'] = date('m-d-Y');
        }

        $goalObj->setTitle($data['title']);
        $goalObj->setReward($data['reward']);
        $goalObj->setAccess(($this->_digitValidator->isValid($data['access']))? $data['access']:1);
        $goalObj->setStatus(($this->_digitValidator->isValid($data['status']))? $data['status']:1);
        $goalObj->setProgress(($this->_digitValidator->isValid($data['progress']))? $data['progress']:0);
        $goalObj->setExpiry(DateTime::createFromFormat('m-d-Y', $data['expiry']));
        $goalObj->setAssignee($assignee);

        return $goalObj;
    }
    public function validateTask(array $data, $taskObj){
        
        if(!$data['title'] || !$this->_alphaValidator->isValid($data['title'])){
            $this->errorMessage[] = 'Task title should be in corrent format';
            $this->errorFound = true; 
        }
        
        if(!$taskObj->getId() && $this->_isGoalWithTitleExist($data['title'],'task')){
            $this->errorMessage[] = 'Task name already exist';
            $this->errorFound = true;
        }
        
        if($this->errorFound){
            return false;
        }
        
        if(!$data['expiry'] || !$this->_dateValidator->isValid($data['expiry'])){
            $data['expiry'] = date('m-d-Y');
        }
        $assignee = $this->validAssignee($data['assignee'], $taskObj->getGoal()->getOwner()->getId());
         
        $taskObj->setTitle($data['title']);
        $taskObj->setProgress(($this->_digitValidator->isValid($data['progress'])) ? $data['progress']:0);
        $taskObj->setPriority(($this->_digitValidator->isValid($data['priority'])) ? $data['priority']:0);
        $taskObj->setStatus(($this->_digitValidator->isValid($data['status'])) ? $data['status']:0);
        $taskObj->setExpiry(DateTime::createFromFormat('m-d-Y', $data['expiry']));
        $taskObj->setAssignee($assignee);
        
        return $taskObj;
    }
    public function validateComment(array $data, $commentObj)
    {
        if(!$data['comment'] || !$this->_alphaValidator->isValid($data['comment'])){
            $this->errorMessage[] = 'Comment text should be in corrent format';
            $this->errorFound = true;
        }
        
        if($this->errorFound){
            return false;
        }
        $commentObj->setComment($data['comment']);
        $commentObj->setStatus(array_key_exists('status', $data)? $data['status']:1);
        return $commentObj;
    }
    
    public function getErrors()
    {
        return $this->errorMessage;
    }

    private function _isGoalWithTitleExist($goalTitle,$goalType="goal")
    {
        if(!$goalTitle){
            return false;
        }
        if($goalType == 'goal'): 
         $goal = $this->em->getRepository('\Odi\Entity\Goal')->findOneByTitle($goalTitle);
        elseif($goalType == 'task'):
         $goal = $this->em->getRepository('\Odi\Entity\Task')->findOneByTitle($goalTitle);
        endif;
        return ($goal)? true:false;
    }
    
    /*
     * Check wheather the user id is valid and a vlid assignee
     */
    public function validAssignee($assigneeId, $ownerId)
    {
        if(!$assigneeId || $assigneeId == $ownerId){
            $assignee = $this->em->getRepository('\Odi\Entity\Assignee')->findOneById($ownerId);
        }else{
            $assignee = $this->em->getRepository('\Odi\Entity\Assignee')->findValidAssignee($assigneeId, $ownerId);
        }

        return $assignee;
    }
    
    /*
     * Check wheather the user id is valid and a vlid assignee
     */
    public function validateGroup(array $data, $groupObj)
    {
        if(!$data['name'] || !$this->_alphaValidator->isValid($data['name'])){
            $this->errorMessage[] = 'Group name should be in corrent format';
            $this->errorFound = true;
        }
        
        if($this->errorFound){
            return false;
        }
        $groupObj->setName($data['name']);
        foreach($groupObj->getMembers() as $member){
            $groupObj->removeMember($member);
        }
        
        foreach($data['members'] as $memberId){
            //@Todo: Need to change while implememt user network
            $userObj = $this->em->getRepository('\Odi\Entity\User')->findOneById($memberId);
            $groupObj->addMember($userObj);
        }
        
        return $groupObj;
    }

}
