<?php
require_once 'BaseService.php';
require_once 'dao/UserDao.php';

class UserService extends BaseService {

    public function __construct() {
        $dao = new UserDao();

        parent::__construct($dao);
    }

    public function getByEmail($email){
        return $this->dao->getByEmail($email);
    }
    public function create($data){
        if(strlen($data['password']) < 5){
            throw new Exception('Password must be at least 5 characters long');
        }
        if(strlen($data['username']) < 3){
            throw new Exception('Username must be at least 3 characters long');
        }
        if($this->dao->getByUsername($data['username'])){
            throw new Exception('Username already exists');
        }
        if($this->dao->getByEmail($data['email'])){
            throw new Exception('Email already exists');
        }
        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
            throw new Exception('Invalid email format');
        }
        return $this->dao->insert($data);
    }
    public function getByUsername($username){
        return $this->dao->getByUsername($username);
    }
}
?>