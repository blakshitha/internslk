<?php
/*
 * Created on Dec 3, 2013
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

namespace Interns\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\Adapter;
use Zend\View\Model\JsonModel;
use Interns\Model\Students;
use Interns\Model\Users;
use Zend\Session\Container;

class UserController extends InternsLKController
{
	protected $adpt;
	
    public function indexAction()
    {
		return new ViewModel(array(
            'students' => $this->getStudentsTable()->fetchAll(),
        ));
    }

	public function loginAction(){
		$sm = $this->getServiceLocator();
        $request = $this->getRequest();
        $successFlag = false;
        $errorMessage = "";
        $userDetailObj = null;
        if ($request->isPost()) {
        	$adpt = $sm->get('Zend\Db\Adapter\Adapter');
        	$data = $request->getPost();
            $users = new Users($adpt);
            $users->exchangeArray($request->getPost());
            $response = $this->getUsersTable()->getUser($data['username'], $data['password']);
            if(!$response){
            	//login failed
            	$errorMessage = "Wrong credentials. Please try again.";
            }
            else{
            	//login successful - get the student data from StudentTable
            	$successFlag = true;
            	if($response->user_type==1){
            		$userDetailObj = $this->getStudentsTable()->getStudentByEmail($data['username']);
            		$this->addUserSession($userDetailObj->name,$userDetailObj->email,$userDetailObj->id,$response->user_type);
            	}
            	else{
            		$userDetailObj = $this->getEmployerTable()->getEmployerByEmail($data['username']);
            		$this->addUserSession($userDetailObj->company_name,$userDetailObj->email,$userDetailObj->id,$response->user_type);
            	}
            	
            }
        } 
        else{
        	$errorMessage = "System Error! Pleaes try again in few minutes.";
        }
		return new JsonModel(array("success"=>$successFlag,"message"=>$errorMessage, "user"=>$userDetailObj, "user_type"=>$response->user_type)); 
    }

    public function editAction()
    {
    	
    }

    public function deleteAction()
    {
    	
    }
    
    public function logoutAction(){
    	$this->clearUserSession();
    	return new JsonModel(array("success"=>true));
    	
    }
    
    public function addUserSession($name, $email, $id, $userType) {
        $userSession = new Container($this->getConstants()->USER_SESSION_CONTAINER);
        $userSession->name = $name;
        $userSession->email = $email;
        $userSession->id = $id;
        $userSession->userType = $userType;
    }
}