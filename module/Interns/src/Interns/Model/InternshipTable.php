<?php
namespace Interns\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Authentication\Adapter\DbTable;
class InternshipTable
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
     public function getInternship($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }
    
    	
    public function saveInternship(Internship $internship)
    {
        $data = array(
            'title' => $internship->title,
            'description'  => $internship->description,
            'reuirements'  => $internship->reuirements,
            'responsbilities'  => $internship->responsbilities,
            'address'  => $internship->address,
            'location_id'  => $internship->location_id,
            'is_fulltime'  => $internship->is_fulltime,
            'is_paid'  => $internship->is_paid,
            'is_available_anytime'  => $internship->is_available_anytime,
            'duration'  => $internship->duration,
            'is_duration_flexible'  => $internship->is_duration_flexible,
            'minimum_duration'  => $internship->minimum_duration,
            'is_virtual'  => $internship->is_virtual,
            'employer_id' => $internship->employer_id,
            'created'  => $internship->created,
            'updated'  => $internship->updated
			
        );

        $id = (int)$internship->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
            
          
        } else {
            if ($this->getInternship($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }
    
    public function getLastInsertInternshipID(){
        return   $internshipid = $this->tableGateway->lastInsertValue;
    }

}