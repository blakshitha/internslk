<?php
namespace Interns\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Interns\Model\Students;
use Interns\Model\FieldCategory;
use Interns\Model\Users;
use Interns\Model\Employer;
use Interns\GlobalConstants;
use Zend\Session\Container;
use Zend\EventManager\EventManagerInterface;

class InternsLKController extends AbstractActionController
{
	protected $studentsTable;
	protected $fieldCategoryTable;
	protected $usersTable;
	protected $locationsTable;
	protected $employerTable;
	protected $internshipRelevanceTable;
    
    public function setEventManager(EventManagerInterface $events)
    {
        parent::setEventManager($events);
 
        $controller = $this;
        $events->attach('dispatch', function ($e) use ($controller) {
	    	$controller->setUserSession();
        }, 100); 
 
        return $this;
    }
    
    
    public function getStudentsTable()
    {
        if (!$this->studentsTable) {
            $sm = $this->getServiceLocator();
            $this->studentsTable = $sm->get('Interns\Model\StudentsTable');
        }
        return $this->studentsTable;
    }
    
    public function getFieldCategoryTable()
    {
        if (!$this->fieldCategoryTable) {
            $sm = $this->getServiceLocator();
            $this->fieldCategoryTable = $sm->get('Interns\Model\FieldCategoryTable');
        }
        return $this->fieldCategoryTable;
    }
    
   	public function getUsersTable()
    {
        if (!$this->usersTable) {
            $sm = $this->getServiceLocator();
            $this->usersTable = $sm->get('Interns\Model\UsersTable');
        }
        return $this->usersTable;
    }
    
    public function getLocationsTable()
    {
        if (!$this->locationsTable) {
            $sm = $this->getServiceLocator();
            $this->locationsTable = $sm->get('Interns\Model\LocationsTable');
        }
        return $this->locationsTable;
    }
  public function getInternshipTable() {
        if (!$this->internshipTable) {
            $sm = $this->getServiceLocator();
            $this->internshipTable = $sm->get('Interns\Model\InternshipTable');
        }
        return $this->internshipTable;
    }
    public function getEmployerTable()
    {
        if (!$this->employerTable) {
            $sm = $this->getServiceLocator();
            $this->employerTable = $sm->get('Interns\Model\EmployerTable');
        }
        return $this->employerTable;
    }
    
    public function getIntershipRelevanceTable()
    {
        if (!$this->internshipRelevanceTable) {
            $sm = $this->getServiceLocator();
            $this->internshipRelevanceTable = $sm->get('Interns\Model\InternshipRelevanceTable');
        }
        return $this->internshipRelevanceTable;
    }
    public function getConstants(){
    	return new GlobalConstants();
    }
    
    public function setUserSession(){
    	$userSession = new Container($this->getConstants()->USER_SESSION_CONTAINER);
    	$this->layout()->name = $userSession->name;
    	$this->layout()->email = $userSession->email;
    	$this->layout()->id = $userSession->id;
    	$this->layout()->user_type = $userSession->userType;
    }
  
	public function getSessionUserID(){
		$userSession = new Container($this->getConstants()->USER_SESSION_CONTAINER);
  		return $userSession->id;
  	}
  
    public function clearUserSession(){
    	$userSession = new Container($this->getConstants()->USER_SESSION_CONTAINER);
    	$userSession->getManager()->getStorage()->clear($this->getConstants()->USER_SESSION_CONTAINER);
    }
}