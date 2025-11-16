<?php
require_once 'BaseService.php';
require_once 'dao/MessageDao.php';
require_once 'dao/ListingDao.php';
require_once 'dao/UserDao.php';

class MessageService extends BaseService {

    private $listingDao;
    private $userDao;

    public function __construct() {
        $dao = new MessageDao();
        $this->listingDao = new ListingDao();
        $this->userDao    = new UserDao();

        parent::__construct($dao);
    }

    // All messages for a listing
    public function getByListing($listing_id) {
        if (!is_numeric($listing_id)) {
            throw new Exception("Invalid listing_id");
        }
        return $this->dao->getByListing($listing_id);
    }

    // Latest message for a listing
    public function getLatestByListing($listing_id) {
        if (!is_numeric($listing_id)) {
            throw new Exception("Invalid listing_id");
        }
        return $this->dao->getLatestByListing($listing_id);
    }

    // Conversation: all messages for a user on a specific listing
    public function getConversation($listing_id, $user_id) {
        if (!is_numeric($listing_id) || !is_numeric($user_id)) {
            throw new Exception("Invalid listing_id or user_id");
        }
        return $this->dao->getConversation($listing_id, $user_id);
    }

    // Create a new message
    public function create($data) {
        // content required
        if (empty(trim($data['content'] ?? ''))) {
            throw new Exception("Message content cannot be empty");
        }

        // listing_id validation + existence
        if (!isset($data['listing_id']) || !is_numeric($data['listing_id'])) {
            throw new Exception("Invalid listing_id");
        }
        $listing = $this->listingDao->getById($data['listing_id']);
        if (!$listing) {
            throw new Exception("Listing does not exist");
        }

        // user_id validation + existence
        if (!isset($data['user_id']) || !is_numeric($data['user_id'])) {
            throw new Exception("Invalid user_id");
        }
        $user = $this->userDao->getById($data['user_id']);
        if (!$user) {
            throw new Exception("User does not exist");
        }

        // BaseDao::insert will handle the insert
        return $this->dao->insert($data);
    }
}
?>
