<?php

namespace Interns\Form;

use Zend\Form\Form;

class InternshipForm extends Form {

    public function __construct($name = null) {
        parent::__construct('internship');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'title',
            'attributes' => array(
                'type' => 'varchar',
            ),
            'options' => array(
                'label' => 'Internship Title',
            ),
        ));
        $this->add(array(
            'name' => 'employer_id',
            'attributes' => array(
                'type' => 'varchar',
            ),
            'options' => array(
                'label' => 'employer_id',
            ),
        ));
        $this->add(array(
            'name' => 'description',
            'attributes' => array(
                'type' => 'Textarea',
            ),
            'options' => array(
                'label' => 'Description',
            ),
        ));
        $this->add(array(
            'name' => 'reuirements',
            'attributes' => array(
                'type' => 'Textarea',
            ),
            'options' => array(
                'label' => 'Reuirements',
            ),
        ));
        $this->add(array(
            'name' => 'responsbilities',
            'attributes' => array(
                'type' => 'Textarea ',
            ),
            'options' => array(
                'label' => 'Responsbilities',
            ),
        ));
        $this->add(array(
            'name' => 'address',
            'attributes' => array(
                'type' => 'varchar',
            ),
            'options' => array(
                'label' => 'Address',
            ),
        ));

        
      $this->add(array(     
		    'type' => 'Zend\Form\Element\MultiCheckbox',       
		    'name' => 'field_category_id',
		    'options' => array(
		        'label' => 'Field Category',
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
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'is_fulltime',
            'attributes' => array(
                'type' => 'tinyint',
            ),
             'options' => array(
                     'label' => 'Hours ?',
                     'value_options' => array(
                             '0' => 'Full-Time',
                             '1' => 'Part-Time',
                     ),
             )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'is_paid',
            'attributes' => array(
                'type' => 'tinyint',
            ),
           'options' => array(
                     'label' => 'Compensation ?',
                     'value_options' => array(
                             '0' => 'Unaid',
                             '1' => 'Paid',
                     ),
             )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'is_available_anytime',
            'attributes' => array(
                'type' => 'tinyint',
            ),
           'options' => array(
                     'label' => 'Available anytime ?',
                     'value_options' => array(
                             '0' => 'No',
                             '1' => 'Yes',
                     ),
             )
        ));
        $this->add(array(
            'name' => 'duration',
            'attributes' => array(
                'type' => 'int',
            ),
            'options' => array(
                'label' => 'Duration',
            ),
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Radio',
            'name' => 'is_duration_flexible',
            'attributes' => array(
                'type' => 'tinyint',
            ),
            'options' => array(
                     'label' => 'Flexible Duration ?',
                     'value_options' => array(
                             '0' => 'No',
                             '1' => 'Yes',
                     ),
             )
        ));
        $this->add(array(
            'name' => 'minimum_duration',
            'attributes' => array(
                'type' => 'int',
            ),
            'options' => array(
                'label' => 'Minimum_duration',
            ),
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'is_virtual',
            'attributes' => array(
                'type' => 'tinyint',
            ),
           'options' => array(
        'label' => 'Virtual',
        'use_hidden_element' => true,
        'checked_value' => '1',
        'unchecked_value' => '0'
    )
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Register',
                'id' => 'InternshipFormSubmitButton',
            ),
        ));
    }

}