<?php
require_once 'BaseDao.php';


class FavoritesDao extends BaseDao {
   public function __construct() {
       parent::__construct("favorites");
   }


   public function addFavorite($user_id, $listing_id) {
       $favorite = ['listing_id' => $listing_id, 'user_id' => $user_id];
       parent::insert($favorite);
   }
}
?>