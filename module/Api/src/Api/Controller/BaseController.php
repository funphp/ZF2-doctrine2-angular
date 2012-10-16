<?php

namespace Api\Controller;

use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\Controller\AbstractRestfulController,
    Zend\View\Model\ViewModel,
    Doctrine\ORM\EntityManager,
    Doctrine\ORM\Query,
    Doctrine\Common\Collections,
    Api\Entity\User,
    Api\Entity\Assignee;
use Api\Model\Validator;

/**
 * Base Controller for api module
 * 
 * all controllers of api module should be inherited from this abstract class
 * 
 * * @mahfuz
 */
abstract class BaseController extends AbstractRestfulController {

    protected $resData;
    protected $resStatus;
    protected $resMsg;
    protected $resHttpCode;
    protected $userObj;
    protected $em;
    protected $assignee;

    public function __construct() {

        $this->resData = array();
        $this->resStatus = 'success'; // success | failure | error
        $this->resMsg = 'Successfully processed';
        $this->resHttpCode = 200;
        // $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $this->userObj = new User();

        $this->assignee = new Assignee();
    }

    public function setEntityManager(EntityManager $em) {
        $this->em = $em;
    }

    public function getEntityManager() {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    public function setEventManager(EventManagerInterface $events) {
        parent::setEventManager($events);

        $controller = $this;
        $events->attach('dispatch', function ($e) use ($controller) {
                    $this->getEntityManager();
                    $this->_validateOauth();
                }, 100); // execute before executing action logic
    }

    public function prepareResult() {

        $res = new \stdClass();
        $res->status = $this->resStatus;
        $res->message = $this->resMsg;
        if ($this->userObj)
            $res->userId = $this->userObj->getId();
        $res->data = $this->resData;


        return $res;
    }

    /**
     * validate oauth 
     * 
     * @param  $reqAccesses  Array, String  required accesses  
     */
    protected function _validateOauth($reqAccesses = null) {
        $access_params = $this->params()->fromQuery();
        // print_r($access_params);die;
        // print_r($this->params()->fromQuery());die;
        //if($reqAccesses && !is_array($reqAccesses)) $reqAccesses = array($reqAccesses);
        //$this->getResponse()->setHeader("WWW-Authenticate", 'OAuth realm="http://'.$_SERVER['HTTP_HOST'].'/"');

        $valid = false;
        if($access_params && is_array($access_params)){
           $valid = true;  
        }
        

        if ($valid) {
            $valid = $this->_setuserObj("okdoitkey", "okdoitrequestkey") ? true : false;
        }

        if (!$valid) {
            $this->resStatus = 'failure';
            $this->resMsg = 'Invalid OAuth';
            $this->resHttpCode = 200; // @todo arif: set correct code

            $this->_forward('stop');
        }
    }

    protected function _setuserObj($consumerKey, $accessToken) {


        $oauthTokenObj = $this->getEntityManager()->getRepository('Api\Entity\OauthToken')->findByKeyAndAccessToken($consumerKey, $accessToken);

        if ($oauthTokenObj)
            $this->userObj = $oauthTokenObj->getOwner();



        return $this->userObj;
    }

    /**
     * do nothing, just stop action forwarding
     */
    public function stopAction() {
        $this->resHttpCode = 401;
        $this->resData['text'] = "Not a valid request.";
    }

}