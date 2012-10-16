<?php

namespace Api\Controller;

use Api\Controller\BaseController;

class GoalController extends BaseController {

    protected $allowedGoalTypes = array('my', 'sent', 'received');
    protected $goalType;
    protected $goalRepo;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Return single resource
     *
     * @param mixed $id
     * @return mixed
     */
    public function get($id) {
       
        if (!$id = $this->getEvent()->getRouteMatch()->getParam('id', false)) {
            $this->resHttpCode = 400;
            return;
        }
       // var_dump($this->_getAllParams());die;
        if($id == 'complete'){
            $this->complete();
            return;
        }
        $goal = $this->em->getRepository('Api\Entity\Goal')->findUserGoal($id, $this->userObj->getId());
        if (!$goal) {
            $this->$this->resHttpCode = 204;
            return false;
        }
        $this->resData['goal'] = $this->_generateGoalArray($goal);
        $this->resHttpCode = 200;
        return $this->prepareResult();
    }

    /**
     * Create a new resource
     *
     * @param mixed $data
     * @return mixed
     */
    public function create($data) {
        
    }

    /**
     * Update an existing resource
     *
     * @param mixed $id
     * @param mixed $data
     * @return mixed
     */
    public function update($id, $data) {
        
    }

    /**
     * Delete an existing resource
     *
     * @param  mixed $id
     * @return mixed
     */
    public function delete($id) {
        
    }

    public function getList() {


        $goals = array();
        if ($this->userObj) {

            $goalsObj = $this->userObj->getMyGoals();


            foreach ($goalsObj as $goal) {
                $goals[] = $this->_generateGoalArray($goal);
            }
        }

        $this->resData['goals'] = $goals;
        return $this->prepareResult();
    }

    public function indexAction() {
        $goals = array();
        if ($this->userObj) {
            $goalsObj = $this->userObj->getMyGoals();
            foreach ($goalsObj as $goal) {
                $goals[] = $this->_generateGoalArray($goal);
            }
        }
        $this->resData['goals'] = $goals;
    }

    public function getAction() {
        if (!$id = $this->_getParam('id', false)) {
            $this->resHttpCode = 400;
            return;
        }
        // var_dump($this->_getAllParams());die;
        if ($id == 'complete') {
            $this->complete();
            return;
        }
        $goal = $this->em->getRepository('\Odi\Entity\Goal')->findUserGoal($id, $this->userObj->getId());
        if (!$goal) {
            $this->$this->resHttpCode = 204;
            return false;
        }
        $this->resData['goal'] = $this->_generateGoalArray($goal);
        $this->resHttpCode = 200;
    }

    public function postAction() {
        //$data = file_get_contents("php://input");
        //$objData = json_decode($data);

        $data = $this->getRequest()->getPost();
        $validator = new Api_Modles_Validator();
        $goalObj = new \Odi\Entity\Goal();
        $goalObj->setOwner($this->userObj);

        if (!$goal = $validator->validateGoal($data, $goalObj)) {
            $this->resData['text'] = $validator->getErrors();
            return false;
        }
        $this->em->persist($goal);
        $this->em->flush();
        $this->resHttpCode = 201;
        $this->resData['goal'] = $this->_generateGoalArray($goal);
    }

    public function putAction() {
        parse_str(file_get_contents("php://input"), $postVars);
        if (!$id = $this->_getParam('id', false)) {
            $this->resData['text'] = "Goal Id is invelid.";
            return;
        }

        $goalObj = $this->em->getRepository('\Odi\Entity\Goal')->findUserGoal($id, $this->userObj->getId());
        if (!$goalObj) {
            $this->resData['text'] = "You dont have permission to access this goal.";
            return;
        }

        $validator = new Api_Modles_Validator();
        $data = $this->_generateGoalArray($goalObj, $postVars);

        if (!$goal = $validator->validateGoal($data, $goalObj)) {
            $this->resData['text'] = $validator->getErrors();
            return false;
        }
        $this->em->persist($goal);
        $this->em->flush();

        $this->getResponse()->setHttpResponseCode(200);
        $this->resData['goal'] = $this->_generateGoalArray($goal);
        ;
    }

    public function deleteAction() {
        //var_dump($this->_getAllParams());die;
        if (!$id = $this->_getParam('id', false)) {
            $this->resHttpCode = 400;
            return;
        }
        $goal = $this->em->getRepository('\Odi\Entity\Goal')->findUserGoal($id, $this->userObj->getId());
        if (!$goal) {
            $this->$this->resHttpCode = 204;
            $this->resData['text'] = "No data found";
            return false;
        }
        $this->em->remove($goal);
        $this->em->flush();
        $this->resData['text'] = "Goal has deleted successfully!";
    }

    public function completeAction() {
        if (!$id = $this->_getParam('id', false)) {
            $this->resHttpCode = 400;
            return;
        }
        $goal = $this->em->getRepository('\Odi\Entity\Goal')->findUserGoal($id, $this->userObj->getId());
        if (!$goal) {
            $this->$this->resHttpCode = 204;
            $this->resData['text'] = "No data found";
            return false;
        }

        $goal->setProgress(100);
        $this->em->persist($goal);
        $this->em->flush();
        $this->resHttpCode = 201;
        $this->resData['goal'] = $this->_generateGoalArray($goal);
        ;
    }

    private function _generateGoalArray($goalObj, $data = array()) {
        if (!$goalObj)
            return false;

        $goal['id'] = $goalObj->getId();
        $goal['title'] = (array_key_exists('title', $data)) ? $data['title'] : $goalObj->getTitle();
        $goal['status'] = (array_key_exists('status', $data)) ? $data['status'] : $goalObj->getStatus();
        $goal['reward'] = (array_key_exists('reward', $data)) ? $data['reward'] : $goalObj->getReward();
        $goal['progress'] = (array_key_exists('progress', $data)) ? $data['progress'] : $goalObj->getProgress();
        $goal['access'] = (array_key_exists('access', $data)) ? $data['access'] : $goalObj->getAccess();
        $goal['expiry'] = (array_key_exists('expiry', $data)) ? $data['expiry'] : $goalObj->getExpiry()->format('m-d-Y');
        $goal['assignee'] = (array_key_exists('assignee', $data)) ? $data['assignee'] : $goalObj->getAssignee()->getId();
        $goal['createdAt'] = $goalObj->getCreatedAt();
        $goal['updatedAt'] = $goalObj->getUpdatedAt();

        return $goal;
    }

}

