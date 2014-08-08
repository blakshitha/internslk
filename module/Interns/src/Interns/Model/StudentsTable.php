<?php
namespace Interns\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Authentication\Adapter\DbTable;

class StudentsTable
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

    public function getStudent($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }
	
	public function getStudentByEmail($email)
    {
        $email  = $email;
        $rowset = $this->tableGateway->select(array('email' => $email));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $email");
        }
        return $row;
    }
	
    public function saveStudent(Students $student)
    {
        $data = array(
            'name' => $student->name,
            'email'  => $student->email,
			'phone' => $student->phone,
			'resume'  => serialize($student->resume),
			'cover_letter' => serialize($student->cover_letter),
        );

        $id = (int)$student->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getStudent($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteStudent($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}