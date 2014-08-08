<?php

namespace Interns\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Db\Adapter\Adapter;

class Internship implements InputFilterAwareInterface {

    public $id;
    public $title;
    public $description;
    public $reuirements;
    public $responsbilities;
    public $address;
    public $location_id;
    public $is_fulltime;
    public $is_paid;
    public $is_available_anytime;
    public $duration;
    public $is_duration_flexible;
    public $minimum_duration;
    public $is_virtual;
    public $created;
    public $updated;
    protected $inputFilter;
    protected $adapter;
    public $employer_id;

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->title = (isset($data['title'])) ? $data['title'] : null;
        $this->description = (isset($data['description'])) ? $data['description'] : null;
        $this->reuirements = (isset($data['reuirements'])) ? $data['reuirements'] : null;
        $this->responsbilities = (isset($data['responsbilities'])) ? $data['responsbilities'] : null;
        $this->address = (isset($data['address'])) ? $data['address'] : null;
        $this->location_id = (isset($data['location_id'])) ? $data['location_id'] : null;
        $this->is_fulltime = (isset($data['is_fulltime'])) ? $data['is_fulltime'] : null;
        $this->is_paid = (isset($data['is_paid'])) ? $data['is_paid'] : null;
        $this->is_available_anytime = (isset($data['is_available_anytime'])) ? $data['is_available_anytime'] : null;
        $this->duration = (isset($data['duration'])) ? $data['duration'] : null;
        $this->is_duration_flexible = (isset($data['is_duration_flexible'])) ? $data['is_duration_flexible'] : null;
        $this->minimum_duration = (isset($data['minimum_duration'])) ? $data['minimum_duration'] : null;
        $this->is_virtual = (isset($data['is_virtual'])) ? $data['is_virtual'] : null;
        $this->employer_id = (isset($data['employer_id'])) ? $data['employer_id'] : null;
        $this->created = (isset($data['created'])) ? $data['created'] : null;
        $this->updated = (isset($data['updated'])) ? $data['updated'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'title',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 255,
                        ),
                    ),
                ),
            )));
			
            $inputFilter->add($factory->createInput(array(
                'name'     => 'description',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 255,
                        ),
                    ),
                  ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name'     => 'responsbilities',
                'required' => false,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));
			$inputFilter->add($factory->createInput(array(
                'name'     => 'address',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 100,
                        ),
                    ),
                ),
            )));
		
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }

}