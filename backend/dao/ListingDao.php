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
   public function getByBrandAndModel($brand, $model) {
       $stmt = $this->connection->prepare("SELECT * FROM listing WHERE brand = :brand AND model = :model");
       $stmt->bindParam(':brand', $brand);
       $stmt->bindParam(':model', $model);
       $stmt->execute();
       return $stmt->fetchAll();
   }

   public function searchListing(){}
}
?>
    