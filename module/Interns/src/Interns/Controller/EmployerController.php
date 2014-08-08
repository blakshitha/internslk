<?php
/*
 * Created on Dec 3, 2013
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
namespace Interns\Controller;

use Zend\View\Model\ViewModel;
use Interns\Form\EmployerRegistrationForm;
use Zend\Db\Adapter\Adapter;
use Interns\Model\Employer;
use Interns\Model\Users;
use Interns\GlobalConstants;

class EmployerController extends InternsLKController
{
	protected $adpt;
	
    public function indexAction()
    {
		return new ViewModel(array());
    }

    public function addAction()
    {
		$form = new EmployerRegistrationForm();
		$locationsList = array();
		$locations = $this->getLocationsTable()->fetchAll();
		foreach($locations as $location){
			$locationsList[$location->id] = $location->name;
		}
		$form->get('location_id')->setAttributes(array(
	         'options' => $locationsList,   
	    )); 
        $form->get('submit')->setValue('Register Now');
		$sm = $this->getServiceLocator();
        $request = $this->getRequest();
        if ($request->isPost()) {
        	$adpt = $sm->get('Zend\Db\Adapter\Adapter');
            $employer = new Employer($adpt);
            $users = new Users($adpt);
            $form->setInputFilter($employer->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
            	$formData = $form->getData();
                $employer->exchangeArray($formData);
                $usersData = array(
				    'email' => $formData['email'],
				    'password' => $formData['password'],
				    'user_type' => $this->getConstants()->USER_TYPE_EMPLOYER,
				);
				$users->exchangeArray($usersData);
                $this->getEmployerTable()->saveEmployer($employer);
				$this->getUsersTable()->saveUser($users);
                return $this->redirect()->toRoute('employer');
            }
        }
        return array('form' => $form);

    }
}

