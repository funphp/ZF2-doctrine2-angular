<?php
include_once APPLICATION_PATH . '/modules/api/models/Validator.php';

class Api_CommentController extends Odi_Api_Controller
{
    protected $commentType;
    protected $typeObj;
    protected $typeId;

    public function init()
    {
        parent::init();
        $this->_validateOauth();
        
        $this->commentType = $this->_getParam('type');
        $this->typeId = $this->_getParam('typeid');
        if(!in_array($this->commentType, array('goal', 'task'))|| !$this->typeId){
            $this->_forward('stop');
        }   
        if($this->commentType == "goal"){
            $this->typeObj = $this->em->getRepository('\Odi\Entity\Goal')->findOneById($this->typeId);   
        }else{
            $this->typeObj = $this->em->getRepository('\Odi\Entity\Task')->findOneById($this->typeId);   
        }
        
    }

    public function indexAction()
    {
        $comments = array();
        if(!$this->typeObj){
            return $this->_forward('stop');
        }
        
        $commentsObj = $this->typeObj->getComments();
        foreach($commentsObj as $comment){
            $comments[] = $this->_generateArray($comment);
        }
        $this->resData['comments'] = $comments;
    }
    
    public function getAction()
    {
         if (!$id = $this->_getParam('id', false)) {
             return $this->stopAction();
         }
         if($this->commentType == "goal"){
             $commentObj = $this->em->getRepository('\Odi\Entity\GoalComment')->getMyValidComment($id, $this->userObj->getId());
         }else{
             $commentObj = $this->em->getRepository('\Odi\Entity\TaskComment')->getMyValidComment($id, $this->userObj->getId());
         }
         
         $this->resData['goal'] = $this->_generateArray($commentObj);
         $this->resHttpCode = 200;   
    }

    public function postAction()
    {
        $data = $this->getRequest()->getPost();
        $validator = new Api_Modles_Validator();
        if($this->commentType == "goal"){
            $commentObj = new \Odi\Entity\GoalComment();
            $commentObj->setGoal($this->typeObj);
        }else{
            $commentObj = new \Odi\Entity\TaskComment();
            $commentObj->setTask($this->typeObj);
        }
        
        if (!$comment = $validator->validateComment($data, $commentObj)) {
            $this->resData['text'] = $validator->getErrors();
            return $this->stopAction();
        }
        $comment->setUser($this->userObj);
        $this->em->persist($comment);
        $this->em->flush();
        $this->resHttpCode = 201;
        $this->resData['goal'] = $this->_generateArray($comment);
    }

    public function putAction()
    {
        $this->resHttpCode     = 503;
        $this->resData['text'] = "unable to process put requests. Please try later";
    }

    public function deleteAction()
    {
        $this->resHttpCode     = 204;
    }
    
    private function _generateArray($commentObj)
    {
        if (!$commentObj)
            return $this->_forward ('stop');
        
        $comment['comment'] = $commentObj->getComment();
        $comment['createdAt'] = $commentObj->getCreatedAt();
        $comment['commentedBy'] = $commentObj->getUser()->getId();
        
        return $comment;
    }
}

