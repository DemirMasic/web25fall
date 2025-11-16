<?php
require_once 'BaseService.php';
require_once 'dao/ImageDao.php';
require_once 'dao/ListingDao.php';

class ImageService extends BaseService {

    private $listingDao;

    public function __construct() {
        $dao = new ImageDao();
        $this->listingDao = new ListingDao();

        parent::__construct($dao);
    }

    // Get all images for one listing
    public function getByListingId($listing_id) {
        if (!is_numeric($listing_id)) {
            throw new Exception("Invalid listing_id");
        }

        return $this->dao->getByListingId($listing_id);
    }

    // Create image with validation
    public function create($data) {
        // Validate listing_id
        if (!isset($data['listing_id']) || !is_numeric($data['listing_id'])) {
            throw new Exception("Invalid listing_id");
        }

        // Ensure listing exists
        $listing = $this->listingDao->getById($data['listing_id']);
        if (!$listing) {
            throw new Exception("Listing does not exist");
        }

        // Validate image_url
        if (empty(trim($data['image_url'] ?? ''))) {
            throw new Exception("image_url cannot be empty");
        }

        // If you want, you could do a light URL validation:
        // if (!filter_var($data['image_url'], FILTER_VALIDATE_URL)) {
        //     throw new Exception("Invalid image_url format");
        // }

        return $this->dao->insert($data);
    }

    // Optional: update image (e.g. change URL or move to different listing)
    public function update($id, $data) {
        if (!is_numeric($id)) {
            throw new Exception("Invalid image id");
        }

        // If listing_id is provided, validate and check existence
        if (isset($data['listing_id'])) {
            if (!is_numeric($data['listing_id'])) {
                throw new Exception("Invalid listing_id");
            }

            $listing = $this->listingDao->getById($data['listing_id']);
            if (!$listing) {
                throw new Exception("Listing does not exist");
            }
        }

        // If image_url is provided, validate it
        if (isset($data['image_url'])) {
            if (empty(trim($data['image_url']))) {
                throw new Exception("image_url cannot be empty");
            }
            // optional strict check:
            // if (!filter_var($data['image_url'], FILTER_VALIDATE_URL)) {
            //     throw new Exception("Invalid image_url format");
            // }
        }

        return $this->dao->update($id, $data);
    }

    // Delete uses BaseService->delete($id) directly, so no override needed
}
?>
