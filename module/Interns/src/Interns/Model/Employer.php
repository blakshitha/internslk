<?php

namespace Interns\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Db\Adapter\Adapter;

class Employer implements InputFilterAwareInterface {

    public $id;
    public $company_name;
    public $contact_person_name;
    public $website;
    public $email;
    public $location_id;
    public $phone;
    public $department;
    public $created;
    public $updated;
    protected $inputFilter;
    protected $adapter;

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->company_name = (isset($data['company_name'])) ? $data['company_name'] : null;
        $this->contact_person_name = (isset($data['contact_person_name'])) ? $data['contact_person_name'] : null;
        $this->website = (isset($data['website'])) ? $data['website'] : null;
        $this->location_id = (isset($data['location_id'])) ? $data['location_id'] : null;
        $this->email = (isset($data['email'])) ? $data['email'] : null;
        $this->phone = (isset($data['phone'])) ? $data['phone'] : null;
        $this->department = (isset($data['department'])) ? $data['department'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                        'name' => 'id',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'Int'),
                        ),
                    )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'company_name',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 1,
                                    'max' => 255,
                                ),
                            ),
                        ),
                    )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'email',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 1,
                                    'max' => 255,
                                ),
                            ),
                            array(
                                'name' => 'EmailAddress',
                                'options' => array(
                                    'domain' => false,
                                ),
                            ),
                            array(
                                'name' => 'Zend\Validator\Db\NoRecordExists',
                                'options' => array(
                                    'adapter' => $this->adapter,
                                    'table' => 'users',
                                    'field' => 'email',
                                    'messages' => array(
                                        'recordFound' => 'Email Address is Already Registered'
                                    ),
                                ),
                            ),
                        ),
                    )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'phone',
                        'required' => false,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 1,
                                    'max' => 100,
                                ),
                            ),
                        ),
                    )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'password',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 1,
                                    'max' => 100,
                                ),
                            ),
                        ),
                    )));
            $inputFilter->add($factory->createInput(array(
                        'name' => 'confirmPassword',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 1,
                                    'max' => 100,
                                ),
                            ),
                            array(
                                'name' => 'Identical',
                                'options' => array(
                                    'token' => 'password',
                                    'messages' => array(
                                        'notSame' => 'Password confirmation do not match'
                                    ),
                                ),
                            ),
                        ),
                    )));
            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}