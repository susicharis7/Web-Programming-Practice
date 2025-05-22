<?php
require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/MenuItemDao.php';

class MenuItemService extends BaseService {

    public function __construct() {
        $dao = new MenuItemDao();
        parent::__construct($dao);
    }

    public function getByCategory($category) {
        return $this->dao->getByCategory($category);
    }

    public function createMenuItem($data) {
        if ($data['price'] <= 0) {
            throw new Exception('Price must be a positive value.');
        }
        return $this->create($data);
    }
}
