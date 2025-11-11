<?php
require_once 'BaseService.php';
require_once 'dao/ListingDao.php';

class ListingService extends BaseService {

    public function __construct() {
        $dao = new ListingDao();

        parent::__construct($dao);
    }

    public function getByBrand($brand){
        return $this->dao->getByBrand($brand);
    }
    public function getByBrandAndModel($brand, $model){
        return $this->dao->getByBrandAndModel($brand, $model);
    }
    
}
?>