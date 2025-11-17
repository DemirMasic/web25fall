<?php
require_once 'BaseDao.php';


class ImageDao extends BaseDao {
   public function __construct() {
       parent::__construct("image");
   }
   public function getByListingId($listing_id) {
        $stmt = $this->connection->prepare("
            SELECT *
            FROM image
            WHERE listing_id = :listing_id
            ORDER BY id ASC
        ");

        $stmt->bindParam(':listing_id', $listing_id);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
?>