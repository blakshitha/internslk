<?php
namespace Interns\Form;

use Zend\Form\Form;

class EmployerRegistrationForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('employer');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'company_name',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Company Name',
            ),
        ));
        $this->add(array(
            'name' => 'contact_person_name',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Contact Person Name',
            ),
        ));
        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Email',
            ),
        ));
		$this->add(array(     
		    'type' => 'Zend\Form\Element\Select',       
		    'name' => 'location_id',
		    'options' => array(
		        'label' => 'Location',
		    ),
		));    
        $this->add(array(
            'name' => 'phone',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Phone',
            ),
        ));
        $this->add(array(
            'name' => 'website',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Website',
            ),
        ));
        $this->add(array(
            'name' => 'department',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Department/Section',
            ),
        ));
		$this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type'  => 'password',
            ),
            'options' => array(
                'label' => 'Password',
            ),
        ));
		$this->add(array(
            'name' => 'confirmPassword',
            'attributes' => array(
                'type'  => 'password',
            ),
            'options' => array(
                'label' => 'Confirm Password',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Register',
                'id' => 'employerRegistrationSubmitButton',
            ),
        ));
    }
    
    public function getLocationList(){
    	return array();
    }
}