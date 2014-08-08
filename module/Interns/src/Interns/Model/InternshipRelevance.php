<?php

namespace Interns\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Db\Adapter\Adapter;

class InternshipRelevance implements InputFilterAwareInterface {

    public $id;
    public $internship_programs_id;
    public $field_categories_id;
    public $created;
    public $updated;
    protected $inputFilter;
    protected $adapter;

    public function __construct(Adapter $adapter) {
        $this->adapter = $adapter;
    }

    public function exchangeArray($data) {
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->internship_programs_id = (isset($data['internship_programs_id'])) ? $data['internship_programs_id'] : null;
        $this->field_categories_id = (isset($data['field_categories_id'])) ? $data['field_categories_id'] : null;
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
           
		
		
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }

}