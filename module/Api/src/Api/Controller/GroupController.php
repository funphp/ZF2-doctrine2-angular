<?php
include_once APPLICATION_PATH . '/modules/api/models/Validator.php';

class Api_GroupController extends Odi_Api_Controller
{

    public function init()
    {
        parent::init();
        $this->_validateOauth();
        
    }

    public function indexAction()
    {
        die('khairul');
        $this->resData['groups'] = array();
    }

    public function getAction()
    {
        $this->resHttpCode     = 404;
        $this->resData['text'] = "requested article 20 not found";
    }

    public function postAction()
    {
        $data = $this->getRequest()->getPost();
        $validator = new Api_Modles_Validator();
        $groupObj = new \Odi\Entity\Group();
        $groupObj->setOwner($this->userObj);
        if (!$group = $validator->validateGroup($data, $groupObj)) {
            $this->resData['text'] = $validator->getErrors();
            return false;
        }
        $this->em->persist($group);
        $this->em->flush();
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

