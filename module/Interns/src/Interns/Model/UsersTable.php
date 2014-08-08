<?php
namespace Interns\Model;

use Zend\Db\TableGateway\TableGateway;

class UsersTable
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
    
    public function getUser($email, $password){
        $rowset = $this->tableGateway->select(array('email' => $email, 'password' => $password));
        //var_dump($rowset);
        $row = $rowset->current();
        if (!$row) {
            return false;
        }
        return $row;
    }
    
    public function saveUser(Users $user)
    {
        $data = array(
            'email' => $user->email,
            'password'  => $user->password,
			'user_type' => $user->user_type,
        );

        $id = (int)$user->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getUser($user->email,$user->password)) {
                $this->tableGateway->update($data, array('email' => $user->email));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }
}