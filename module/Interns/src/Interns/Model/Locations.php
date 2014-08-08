<?php
namespace Interns\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;              
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;        
use Zend\Db\Adapter\Adapter;

class Locations implements InputFilterAwareInterface             
{
    public $id;
    public $name;
	
	protected $inputFilter;  
	protected $adapter;
	
	
	public function __construct(Adapter $adapter){
		$this->adapter = $adapter;
	}
	
    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->name = (isset($data['name'])) ? $data['name'] : null;
    }
	
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }

}