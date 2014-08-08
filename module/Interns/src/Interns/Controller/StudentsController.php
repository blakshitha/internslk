<?php
namespace Interns \ Controller;

use Zend \ Mvc \ Controller \ AbstractActionController;
use Zend \ View \ Model \ ViewModel;
use Interns \ Model \ Students;
use Interns \ Model \ Users;
use Interns \ Form \ StudentRegistrationForm;
use Interns \ Form \ StudentProfileEditForm;
use Zend \ Db \ Adapter \ Adapter;

class StudentsController extends InternsLKController {
	protected $adpt;

	public function indexAction() {
		return new ViewModel(array (
			'fieldCategories' => $this->getFieldCategoryTable()->fetchAll(),
			
		));
	}

	public function addAction() {
		$form = new StudentRegistrationForm();
		$form->get('submit')->setValue('Register Now');
		$sm = $this->getServiceLocator();
		$request = $this->getRequest();
		if ($request->isPost()) {
			$adpt = $sm->get('Zend\Db\Adapter\Adapter');
			$students = new Students($adpt);
			$users = new Users($adpt);
			$form->setInputFilter($students->getInputFilterAdd());
			$form->setData($request->getPost());

			if ($form->isValid()) {
				$formData = $form->getData();
				$students->exchangeArray($formData);
				$usersData = array (
					'email' => $formData['email'],
					'password' => $formData['password'],
					'user_type' => $this->getConstants()->USER_TYPE_STUDENT,
					
				);
				$users->exchangeArray($usersData);

				$this->getStudentsTable()->saveStudent($students);
				$this->getUsersTable()->saveUser($users);
				return $this->redirect()->toRoute('student');
			}
		}
		return array (
			'form' => $form
		);

	}

	public function deleteAction() {

	}

	public function editAction() {
		$id = (int) $this->params()->fromRoute('id', 0);
		if (!$id) {
			return $this->redirect()->toRoute('student', array (
				'action' => 'add'
			));
		}

		$student = $this->getStudentsTable()->getStudent($id);

		$form = new StudentProfileEditForm();
		$form->bind($student);
		$form->get('submit')->setAttribute('value', 'Save');

		$request = $this->getRequest();
		if ($request->isPost()) {
			$post = array_merge_recursive($request->getPost()->toArray(), $request->getFiles()->toArray());
			$form->setInputFilter($student->getInputFilterInEdit());
			$resume_extension = pathinfo($post['resume']['name'], PATHINFO_EXTENSION);
			$cover_extension = pathinfo($post['cover_letter']['name'], PATHINFO_EXTENSION);
			//$adapter->setDestination('./data/uploads/');
			$filter = new \ Zend \ Filter \ File \ Rename(array (
				"target" => "./data/uploads/resume_" . $post['id'] . "." . $resume_extension,
				"randomize" => false,
				"overwrite" => true,
			));
			$filter2 = new \ Zend \ Filter \ File \ Rename(array (
				"target" => "./data/uploads/cover_" . $post['id'] . "." . $cover_extension,
				"randomize" => false,
				"overwrite" => true,
				
			));
			$form->setData($post);
			if ($form->isValid()) {
				$filter->filter($post['resume']);
				$filter2->filter($post['cover_letter']);
				$this->getStudentsTable()->saveStudent($form->getData());
				return $this->redirect()->toRoute('student');
			}
		}

		return array (
			'id' => $id,
			'form' => $form,
			
		);
	}
}