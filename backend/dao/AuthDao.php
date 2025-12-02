<?php
require_once 'BaseDao.php';


class AuthDao extends BaseDao {
   protected $table_name;


   public function __construct() {
       $this->table_name = "user";
       parent::__construct($this->table_name);
   }


   public function get_user_by_email($email) {
       $stmt = $this->connection->prepare("SELECT * FROM user WHERE email = :email");
       $stmt->bindParam(':email', $email);
       $stmt->execute();
       return $stmt->fetch();
   }
}
