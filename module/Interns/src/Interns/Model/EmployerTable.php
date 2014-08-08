<?php
namespace Interns\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Authentication\Adapter\DbTable;

class EmployerTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getEmployer($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }
	
	public function getEmployerByEmail($email)
    {
        $email  = $email;
        $rowset = $this->tableGateway->select(array('email' => $email));
        //var_dump($rowset);
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $email");
        }
        return $row;
    }
	
    public function saveEmployer(Employer $employer)
    {
        $data = array(
            'company_name'  => $employer->company_name,
			'contact_person_name' => $employer->contact_person_name,
			'email' => $employer->email,
			'phone' => $employer->phone,
			'department' => $employer->department,
			'website' => $employer->website,
			'location_id' => $employer->location_id,
        );

        $id = (int)$employer->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getEmployer($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }
}