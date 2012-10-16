<?php
include_once APPLICATION_PATH . '/modules/api/models/Validator.php';

class Api_TaskController extends Odi_Api_Controller
{
    
    public function init()
    {
        parent::init();        
        $this->_validateOauth();
    }
    
/**
 *  this function will return user all task
 *  @return json object
 */
    public function indexAction()
    {
       $task = array();
      
       if($this->userObj){
           
          $taskObj = $this->userObj->getTasks();
           foreach ($taskObj as $goal) {
               $task[] = $this->_generateTaskArray($goal);
           }
       }
      
        $this->resData['task'] = $task;
        
}
/**
 * get due task today
 */
public function duetaskAction(){
     $task = array();
      
       if($this->userObj){
           
          $taskObj = $this->em->getRepository('\Odi\Entity\Task')->getDueTask();
           foreach ($taskObj as $goal) {
               $task[] = $this->_generateTaskArray($goal);
           }
       }
      
        $this->resData['task'] = $task;
}
/**
 *  this function will terurn overdue form today
 */
public function overduetaskAction(){
     $task = array();
      
       if($this->userObj){
           
          $taskObj = $this->em->getRepository('\Odi\Entity\Task')->getOverDueTask();
           foreach ($taskObj as $goal) {
               $task[] = $this->_generateTaskArray($goal);
           }
       }
      
        $this->resData['task'] = $task;
}

/**
 * this function will return a specific task destils
 * @param Integer goalId
 * @param Integer taskId
 * @return Json Object
 */
    public function getAction()
    { 
        if (!$id = $this->_getParam('id', false)) {
            $this->resHttpCode = 400;
            return;
        }
        
        $data = $this->getRequest()->getParams();
        $task = $this->em->getRepository('\Odi\Entity\Task')->findOneById($id);
       
        $this->resData['task'] = $this->_generateTaskArray($task);
        $this->resHttpCode     = 201;
        //$this->resData['text'] = "requested task found";
    }

    /**
     * This function will add a Task under a goal
     * @param Interger goalId
     * @param String title
     * @param Integer priority
     * @param Integer progress
     * @param Integer status
     * @param Integer asignee
     * @return type false / Json Object
     */
    public function postAction()
    {
        if (!$id = $this->_getParam('goalId', false)) {
            $this->resData['text'] = "Goal Id is invalid.";
            return;
        }
        
        $data = $this->getRequest()->getPost();
        $validator = new Api_Modles_Validator();
        
       
        $goal = $this->em->getRepository('\Odi\Entity\Goal')->findUserGoal($id, $this->userObj->getId());
        $taskObj = new \Odi\Entity\Task();
        $taskObj->setGoal($goal);

        if (!$task = $validator->validateTask($data, $taskObj)) {
            $this->resData['text'] = $validator->getErrors();
            return false;
        }
        $this->em->persist($task);
        $this->em->flush();
        $this->resHttpCode = 200;
        $this->resData['goal'] = $this->_generateTaskArray($task);
        //$this->resData['text'] = "created the goal\n http://zfrest.example.com/article/5";
    }
/**
 * This function will Update a Task under a goal
     * @param Interger goalId
     * @param String title
     * @param Integer priority
     * @param Integer progress
     * @param Integer status
     * @param Integer asignee
     * @return type false / Json Object
 * @return type 
 */
    public function putAction()
    {
         //parse_str(file_get_contents("php://input"), $postVars);
         $postVars=  json_decode(file_get_contents("php://input"),true);
        
       
        if (!$id = $postVars['id']) {
            $this->resData['text'] = "Task Id is invalid.";
            return;
        }
        
        $validator = new Api_Modles_Validator();
        $taskObj = $this->em->getRepository('\Odi\Entity\Task')->findOneById($id);
        
        if (!$taskObj) {
            $this->resData['text'] = "You dont have permission to access this Task.";
            return;
        }
        
        $data = $this->_generateTaskArray($taskObj, $postVars);
        
       if (!$task = $validator->validateTask($data, $taskObj)) {
            $this->resData['text'] = $validator->getErrors();
            return false;
        }
        $this->em->persist($task);
        $this->em->flush();
        $this->resHttpCode = 200;
        $this->resData['goal'] = $this->_generateTaskArray($task);
        $this->resData['text'] = " successfully to process put requests.";
    }
/**
 * this function will delete an task
 * @param Integer taskId
 * @return type Json
 */
    public function deleteAction()
    {
        if(!$id = $this->_getParam('id', false)){
            $this->resHttpCode = 400;
            $this->resData['text'] = "Invalid Task Id";
            return;
        }
        
         $taskObj = $this->em->getRepository('\Odi\Entity\Task')->findOneById($id);
         
         $this->em->remove($taskObj);
         $this->em->flush();
         $this->resData['text'] = "Task has deleted successfully!";
         $this->resHttpCode     = 200;
    }
    
    public function moveAction()
    { 
        if(!$id = $this->_getParam('id', false)){
            $this->resHttpCode = 400;
            $this->resData['text'] = "Invalid Task Id";
            return;
        }
        $goalId = $this->_getParam('goalid', false);
        $goalObj = $this->em->getRepository('\Odi\Entity\Goal')->findUserGoal($goalId, $this->userObj->getId);
        if(!$goalObj){
            return $this->stopAction();
        }   
        $taskObj = $this->em->getRepository('\Odi\Entity\Task')->findOneById($id);
        $taskObj->setGoal($goalObj);
        $this->em->persist($task);
        $this->em->flush();
        $this->resHttpCode = 200;
        $this->resData['text'] = "Successfully change the goal.";
    }

    /**
     *  This function will generate task array
     * @param type Object $taskObj
     * @param type Array $data
     * @return type Array 
     */
 private function _generateTaskArray($taskObj, $data = array())
    {
        if (!$taskObj)
            return false;
        
        $task['id'] = $taskObj->getId();
        $task['title'] = (array_key_exists('title', $data))? $data['title']:$taskObj->getTitle();
        $task['status'] = (array_key_exists('status', $data))? $data['status']:$taskObj->getStatus();
        $task['priority'] = (array_key_exists('priority', $data))? $data['priority']:$taskObj->getPriority();
        $task['progress'] = (array_key_exists('progress', $data))? $data['progress']:$taskObj->getProgress();
       
        $task['expiry'] = (array_key_exists('expiry', $data))? $data['expiry']:$taskObj->getExpiry()->format( 'm-d-Y' );
        $task['goalId'] = (array_key_exists('goalId', $data))? $data['goalId']:$taskObj->getGoal()->getId();
        $task['createdAt'] = $taskObj->getCreatedAt();
        $task['updatedAt'] = $taskObj->getUpdatedAt();
        $task['assignee'] = (array_key_exists('assignee', $data))? $data['assignee']:$taskObj->getAssignee();

        return $task;
    }
}

