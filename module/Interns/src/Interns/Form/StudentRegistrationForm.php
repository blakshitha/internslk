<?php
namespace Interns\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class StudentRegistrationForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('student');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Name',
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
            'name' => 'phone',
            'attributes' => array(
                'type'  => 'text',
            ),
            'options' => array(
                'label' => 'Phone',
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
                'id' => 'studentRegistrationSubmitButton',
            ),
        ));
        
        $resume = new Element\File('resume');
        $resume->setLabel('Resume')
             ->setAttribute('id', 'resume');
        $this->add($resume);
        
        $cover_letter = new Element\File('cover_letter');
        $cover_letter->setLabel('Cover Letter')
             ->setAttribute('id', 'cover_letter');
        $this->add($cover_letter);
    }
}