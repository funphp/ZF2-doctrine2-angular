<?php

class Api_AttachmentController extends Odi_Api_Controller
{
    protected $allowedGoalTypes = array('my', 'sent', 'received');
    protected $goalType;

    public function init()
    {
        parent::init();  
        $this->_validateOauth();
        
        $goalType = $this->getRequest()->getParam('type');
        $goalType = in_array($goalType, $this->allowedGoalTypes) ? $goalType : $this->allowedGoalTypes[0];
        
        $this->goalType = $goalType;
    }

    public function indexAction()
    {
        //$this->resData['text'] = "all articles content";
        $this->resData['goals'] = array();
    }

    public function getAction()
    {
        $this->resHttpCode     = 404;
        $this->resData['text'] = "requested article 20 not found";
    }

    public function postAction()
    {
        $this->resHttpCode     = 201;
        $this->resData['text'] = "created the article\nhttp://zfrest.example.com/article/5";
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
}

