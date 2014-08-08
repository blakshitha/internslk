<?php
namespace Interns\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Authentication\Adapter\DbTable;
class InternshipRelevanceTable
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
     public function getInternshipRelevance($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }
    
    	
    public function saveInternshipRelevance(InternshipRelevance $internshipRelevance)
    {
        $data = array(
            'internship_programs_id' => $internshipRelevance->internship_programs_id,
            'field_categories_id'  => $internshipRelevance->field_categories_id,
            'created'  => $internshipRelevance->created,
            'updated'  => $internshipRelevance->updated
			
        );

        $id = (int)$internshipRelevance->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getInternshipRelevance($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

}