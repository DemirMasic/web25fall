<?php
require_once 'BaseService.php';
require_once 'dao/FavoritesDao.php';
require_once 'dao/ListingDao.php';

class FavoritesService extends BaseService {

    private $listingDao;

    public function __construct() {
        $dao = new FavoritesDao();
        $this->listingDao = new ListingDao();

        parent::__construct($dao);
    }

    // Get all favorites for a given user
    public function getByUserId($user_id) {
        return $this->dao->getByUserId($user_id);
    }

    // Add a favorite (with validation that listing exists)
    public function addFavorite($user_id, $listing_id) {
        // basic sanity check (optional, but nice to have)
        if (!is_numeric($user_id) || !is_numeric($listing_id)) {
            throw new Exception('Invalid user_id or listing_id');
        }

        // check that the listing exists before favoriting
        $listing = $this->listingDao->getById($listing_id);
        if (!$listing) {
            throw new Exception('Listing does not exist');
        }

        return $this->dao->addFavorite($user_id, $listing_id);
    }

    // Delete a favorite for a given user + listing
    public function deleteFavorite($user_id, $listing_id) {
        if (!is_numeric($user_id) || !is_numeric($listing_id)) {
            throw new Exception('Invalid user_id or listing_id');
        }

        return $this->dao->deleteFavorite($user_id, $listing_id);
    }
}
?>
