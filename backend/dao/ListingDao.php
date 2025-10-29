<?php
require_once 'BaseDao.php';


class ListingDao extends BaseDao {
   public function __construct() {
       parent::__construct("listing");
   }


   public function getByBrand($brand) {
       $stmt = $this->connection->prepare("SELECT * FROM listing WHERE brand = :brand");
       $stmt->bindParam(':brand', $brand);
       $stmt->execute();
       return $stmt->fetch();
   }

   public function searchListing(){}
}
?>
    