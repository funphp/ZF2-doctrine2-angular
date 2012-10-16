<?php

namespace Api\Controller;
use Api\Controller\BaseController;


/**
 *
 */
class InfoController extends BaseController {

    /**
     * @var Doctrine\ORM\EntityManager
     */
   public function __construct() {
        parent::__construct();
    }
    
    /**
     * Return list of resources
     *
     * @return array
     */
    public function getList() {
        /* $data =  array(
          'albums' => $this->getEntityManager()->getRepository('Api\Entity\Album')->findAll(Query::HYDRATE_ARRAY)
          ); */
        if ($this->userObj) {
        $data = $this->getEntityManager()->getRepository('Api\Entity\Goal')->findAll();
        $json_data = $this->_generateAlbumArray($data, array(), 1);
         $this->resData['goals'] = $json_data;
        }
         return $this->prepareResult();
    }

    /**
     * Return single resource
     *
     * @param mixed $id
     * @return mixed
     */
    public function get($id) {
        $data = array(
            'id' => $id
        );

        return $data;
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

    private function _generateAlbumArray($albumObj, $data = array(), $islist = 0) {
        if (!$albumObj)
            return false;

        if ($islist == 1) {
            $i = 0;
            foreach ($albumObj as $goalObj) {
                 $goal[$i]['id'] = $goalObj->getId();
        $goal[$i]['title'] = (array_key_exists('title', $data)) ? $data['title'] : $goalObj->getTitle();
        $goal[$i]['status'] = (array_key_exists('status', $data)) ? $data['status'] : $goalObj->getStatus();
        $goal[$i]['reward'] = (array_key_exists('reward', $data)) ? $data['reward'] : $goalObj->getReward();
        $goal[$i]['progress'] = (array_key_exists('progress', $data)) ? $data['progress'] : $goalObj->getProgress();
        $goal[$i]['access'] = (array_key_exists('access', $data)) ? $data['access'] : $goalObj->getAccess();
        $goal[$i]['expiry'] = (array_key_exists('expiry', $data)) ? $data['expiry'] : $goalObj->getExpiry()->format('m-d-Y');
        $goal[$i]['assignee'] = (array_key_exists('assignee', $data)) ? $data['assignee'] : $goalObj->getAssignee()->getId();
        $goal[$i]['createdAt'] = $goalObj->getCreatedAt();
        $goal[$i]['updatedAt'] = $goalObj->getUpdatedAt();
                $i++;
            }
        } else {
             $goal['id'] = $albumObj->getId();
        $goal['title'] = (array_key_exists('title', $data)) ? $data['title'] : $albumObj->getTitle();
        $goal['status'] = (array_key_exists('status', $data)) ? $data['status'] : $albumObj->getStatus();
        $goal['reward'] = (array_key_exists('reward', $data)) ? $data['reward'] : $albumObj->getReward();
        $goal['progress'] = (array_key_exists('progress', $data)) ? $data['progress'] : $albumObj->getProgress();
        $goal['access'] = (array_key_exists('access', $data)) ? $data['access'] : $albumObj->getAccess();
        $goal['expiry'] = (array_key_exists('expiry', $data)) ? $data['expiry'] : $albumObj->getExpiry()->format('m-d-Y');
        $goal['assignee'] = (array_key_exists('assignee', $data)) ? $data['assignee'] : $albumObj->getAssignee()->getId();
        $goal['createdAt'] = $albumObj->getCreatedAt();
        $goal['updatedAt'] = $albumObj->getUpdatedAt();
        }
        return $goal;
    }

}
