<?php
/*
 * This clss is for validate input form the user
 * over api protocol.
 */
namespace Api\Model;
class Goal
{
    public function prepareGoalObject(array $data, &$errorMessage)
    {
    }
    
    /*
     * Check wheather the user id is valid and a vlid assignee
     */
    public function validAssignee($assigneeId)
    {
        if(!$assigneeId){
            return false;
        }
        $em= \Zend_Registry::get('doctrine')->getEntityManager();
        $assignee = $em->getRepository('\Odi\Entity\User')->findInMyNetwork($consumerKey);
        return $assignee;
    }
    
}
