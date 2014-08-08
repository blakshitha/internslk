<?php
namespace Interns\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;              
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;        
use Zend\Db\Adapter\Adapter;

class Users implements InputFilterAwareInterface             
{
    public $id;
    public $email;
    public $password;
    public $user_type;
	
	protected $inputFilter;  
	protected $adapter;
	
	
	public function __construct(Adapter $adapter){
		$this->adapter = $adapter;
	}
	
    public function exchangeArray($data)
    {
        $this->id     = (isset($data['id'])) ? $data['id'] : null;
        $this->email = (isset($data['email'])) ? $data['email'] : null;
        $this->password = (isset($data['password'])) ? $data['password'] : null;
        $this->user_type = (isset($data['user_type'])) ? $data['user_type'] : null;
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