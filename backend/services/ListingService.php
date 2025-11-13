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
    public function create($data) {
    // Validate year
    if (!isset($data['year']) || !is_numeric($data['year']) || $data['year'] < 1900 || $data['year'] > date("Y") + 1) {
        throw new Exception('Invalid year');
    }

    // Validate mileage
    if (!isset($data['mileage']) || !is_numeric($data['mileage']) || $data['mileage'] < 0) {
        throw new Exception('Invalid mileage value');
    }

    // Validate power
    if (!isset($data['power']) || !is_numeric($data['power']) || $data['power'] <= 0) {
        throw new Exception('Invalid power value');
    }

    // Validate price
    if (!isset($data['price']) || !is_numeric($data['price']) || $data['price'] <= 0) {
        throw new Exception('Invalid price value');
    }

    // Validate description
    if (!isset($data['description']) || strlen(trim($data['description'])) < 5) {
        throw new Exception('Description must be at least 5 characters long');
    }

    // Validate gearbox
    $validGearboxes = ['Manual', 'Automatic'];
    if (!isset($data['gearbox']) || !in_array($data['gearbox'], $validGearboxes)) {
        throw new Exception('Invalid gearbox type');
    }

    // Validate fuel
    $validFuels = ['Diesel', 'Gasoline'];
    if (!isset($data['fuel']) || !in_array($data['fuel'], $validFuels)) {
        throw new Exception('Invalid fuel type');
    }

    // Validate drivetrain
    $validDrivetrains = ['Front-wheel drive', 'Rear-wheel drive', 'All-wheel drive'];
    if (!isset($data['drivetrain']) || !in_array($data['drivetrain'], $validDrivetrains)) {
        throw new Exception('Invalid drivetrain type');
    }

    // If all good, insert into DB
    return $this->dao->insert($data);
    
    }

    
}
?>