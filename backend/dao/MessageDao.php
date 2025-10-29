<?php
require_once 'BaseDao.php';


class MessageDao extends BaseDao {
   public function __construct() {
       parent::__construct("message");
   }


   public function getMessageLatest($message_id) {
       $stmt = $this->connection->prepare("SELECT * FROM user WHERE message_id = :message_id ORDER BY created_at ASC");
       $stmt->bindParam(':message_id', $message_id);
       $stmt->execute();
       return $stmt->fetch();
   }
}
?>
    