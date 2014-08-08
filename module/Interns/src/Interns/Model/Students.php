<?php
namespace Interns\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;              
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;        
use Zend\Db\Adapter\Adapter;

class Students implements InputFilterAwareInterface             
{
    public $id;
    public $name;
    public $email;
	public $phone;
	public $password;
	public $resume;
	public $cover_letter;
	public $created;
	public $updated;
	
	protected $inputFilter;  
	protected $inputFilterInEdit;  
	protected $adapter ;
	
	
	public function __construct(Adapter $adapter){
		$this->adapter = $adapter;
	}
	
    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->name = (isset($data['name'])) ? $data['name'] : null;
        $this->email  = (isset($data['email'])) ? $data['email'] : null;
		$this->phone  = (isset($data['phone'])) ? $data['phone'] : null;
		//$this->password  = (isset($data['password'])) ? $data['password'] : null;
		$this->created  = (isset($data['created'])) ? $data['created'] : null;
		$this->updated  = (isset($data['updated'])) ? $data['updated'] : null;
		$this->resume  = (isset($data['resume'])) ? $data['resume'] : null;
		$this->cover_letter  = (isset($data['cover_letter'])) ? $data['cover_letter'] : null;
    }
	
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilterAdd()
    {
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
                'name'     => 'name',
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
                'name'     => 'email',
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
                    array(
                        'name'    => 'EmailAddress',
                        'options' => array(
                            'domain' => false,
                        ),
                    ),
                    array(
                        'name'    => 'Zend\Validator\Db\NoRecordExists',
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
                'name'     => 'phone',
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
                'name'     => 'password',
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
			$inputFilter->add($factory->createInput(array(
                'name'     => 'confirmPassword',
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
                    array(
                        'name'    => 'Identical',
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

    public function getInputFilter()
    {
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
                'name'     => 'name',
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
                'name'     => 'email',
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
                    array(
                        'name'    => 'EmailAddress',
                        'options' => array(
                            'domain' => false,
                        ),
                    ),
                ),
            )));
            $inputFilter->add($factory->createInput(array(
                'name'     => 'phone',
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
            
            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    public function getInputFilterInEdit()
    {
        if (!$this->inputFilter) {
            $inputFilterInEdit = new InputFilter();
            $factory     = new InputFactory();

            $inputFilterInEdit->add($factory->createInput(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilterInEdit->add($factory->createInput(array(
                'name'     => 'name',
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
			
            $inputFilterInEdit->add($factory->createInput(array(
                'name'     => 'email',
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
                    array(
                        'name'    => 'EmailAddress',
                        'options' => array(
                            'domain' => false,
                        ),
                    ),
                ),
            )));
            $inputFilterInEdit->add($factory->createInput(array(
                'name'     => 'phone',
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
            $this->inputFilterInEdit = $inputFilterInEdit;
        }

        return $this->inputFilterInEdit;
    }

	public function getArrayCopy()
	{
	    return get_object_vars($this);
	}
}