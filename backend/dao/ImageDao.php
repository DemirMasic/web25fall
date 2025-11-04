<?php
require_once 'BaseDao.php';


class ImageDao extends BaseDao {
   public function __construct() {
       parent::__construct("image");
   }
}
?>