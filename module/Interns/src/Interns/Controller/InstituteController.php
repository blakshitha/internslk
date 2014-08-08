<?php
/*
 * Created on Dec 3, 2013
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

namespace Interns\Controller;

use Zend\View\Model\ViewModel;
use Interns\Form\StudentRegistrationForm;
use Zend\Db\Adapter\Adapter;

class InstituteController extends InternsLKController
{
	protected $adpt;
	
    public function indexAction()
    {
		return new ViewModel(array(
            'students' => $this->getStudentsTable()->fetchAll(),
        ));
    }

    public function addAction()
    {
		$form = new StudentRegistrationForm();
        $form->get('submit')->setValue('Register Now');
		$sm = $this->getServiceLocator();
        $request = $this->getRequest();
        if ($request->isPost()) {
        	$adpt = $sm->get('Zend\Db\Adapter\Adapter');
            $students = new Students($adpt);
            $form->setInputFilter($students->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $students->exchangeArray($form->getData());
                $this->getStudentsTable()->saveStudent($students);

                return $this->redirect()->toRoute('student');
            }
        }
        return array('form' => $form);

    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }
}