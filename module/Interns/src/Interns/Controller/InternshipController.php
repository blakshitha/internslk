<?php

namespace Interns\Controller;
use Interns\Form\InstituteRegistrationForm;
use Zend\View\Model\ViewModel;
use Zend\Db\Adapter\Adapter;
use Interns\Model\FieldCategory;
use Interns\Model\Internship;
use Interns\Form\InternshipForm;
use Interns\Model\InternshipRelevance;

class InternshipController extends InternsLKController {

    protected $adpt;
    protected $internshipTable;

    public function listInternshipsAction() {
        return new ViewModel(array('locations' => $this->getLocationsTable()->fetchAll()));
    }

   

   
    public function addAction() {

        $form = new InternshipForm();
        $form->get('submit')->setValue('Post Internship');
       // $form->get('employer_id')->setAttribute('value', $this->getSessionUserID());
        $locationsList = array();
		$locations = $this->getLocationsTable()->fetchAll();
		foreach($locations as $location){
			$locationsList[$location->id] = $location->name;
		}
		$form->get('location_id')->setAttributes(array(
	         'options' => $locationsList,   
	    ));
                $fieldCategoryList=array();
                $categories=  $this->getFieldCategoryTable()->fetchAll();
                foreach ($categories as $mycategory) {
                    $fieldCategoryList[$mycategory->id]=$mycategory->name;
                    
                }
                $form->get('field_category_id')->setAttributes(array(
	         'options' => $fieldCategoryList,   
	    ));
        $sm = $this->getServiceLocator();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $adpt = $sm->get('Zend\Db\Adapter\Adapter');
            $internship = new Internship($adpt);

            $form->setInputFilter($internship->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $formData = $form->getData();

                $internship->exchangeArray($formData);
				

               $this->getInternshipTable()->saveInternship($internship);
               //print_r($formData);
               $lastInsertInternShipId= $this->getInternshipTable()->getLastInsertInternshipID();
               $fieldCaregoryIds = $formData['field_category_id'];
               foreach ($fieldCaregoryIds as $key => $value) {
                    $internshipRelevance=new InternshipRelevance($adpt);
                    $fildCatArray = array();
                    $fildCatArray['internship_programs_id'] = $lastInsertInternShipId;
                    $fildCatArray['field_categories_id'] = $value;
                	$internshipRelevance->exchangeArray($fildCatArray);
                	$this->getIntershipRelevanceTable()->saveInternshipRelevance($internshipRelevance);
               }
              
              // print_r($aaa);
              return $this->redirect()->toRoute('interns');
            }
        }
        return array('form' => $form);
    }

    public function deleteAction() {
        
    }

}