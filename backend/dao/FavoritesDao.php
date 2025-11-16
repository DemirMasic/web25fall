<?php
require_once 'BaseDao.php';

class FavoritesDao extends BaseDao {
   public function __construct() {
       parent::__construct("favorites");
   }

   public function addFavorite($user_id, $listing_id) {
       $favorite = ['listing_id' => $listing_id, 'user_id' => $user_id];
       return parent::insert($favorite);
   }

   public function getByUserId($user_id) {
        $stmt = $this->connection->prepare("
            SELECT * FROM favorites
            WHERE user_id = :user_id
        ");

        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        return $stmt->fetchAll();
    }
   

   public function deleteFavorite($user_id, $listing_id) {
        $stmt = $this->connection->prepare("
            DELETE FROM favorites
            WHERE user_id = :user_id AND listing_id = :listing_id
        ");

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':listing_id', $listing_id);

        $stmt->execute();

        return $stmt->rowCount();

    }
}
?>
