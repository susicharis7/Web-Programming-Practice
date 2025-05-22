<?php
require_once __DIR__ . '/BaseDao.php';

class MenuItemDao extends BaseDao {

    public function __construct() {
        parent::__construct("menu_items");
    }

    public function getByCategory($category) {
        return $this->query(
            "SELECT * FROM menu_items WHERE category = :category",
            ["category" => $category]
        );
    }

    public function insert($data) {
        return parent::insert($data);
    }
}
