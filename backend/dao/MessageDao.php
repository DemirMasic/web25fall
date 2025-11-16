<?php
require_once 'BaseDao.php';

class MessageDao extends BaseDao {
    public function __construct() {
        parent::__construct("message");
    }

    // Get all messages for a listing
    public function getByListing($listing_id) {
        $stmt = $this->connection->prepare("
            SELECT *
            FROM message
            WHERE listing_id = :listing_id
            ORDER BY created_at ASC
        ");

        $stmt->bindParam(':listing_id', $listing_id);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Get the latest message for a listing
    public function getLatestByListing($listing_id) {
        $stmt = $this->connection->prepare("
            SELECT *
            FROM message
            WHERE listing_id = :listing_id
            ORDER BY created_at DESC
            LIMIT 1
        ");

        $stmt->bindParam(':listing_id', $listing_id);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function getConversation($listing_id, $user_id) {
        $stmt = $this->connection->prepare("
            SELECT *
            FROM message
            WHERE listing_id = :listing_id
              AND user_id    = :user_id
            ORDER BY created_at ASC
        ");

        $stmt->bindParam(':listing_id', $listing_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
?>
