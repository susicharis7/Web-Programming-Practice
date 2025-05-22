<?php
require_once __DIR__ . '/BaseDao.php';

class OrderDao extends BaseDao {

    public function __construct() {
        parent::__construct("orders");
    }

    public function getByUserId($user_id) {
        return $this->query(
            "SELECT * FROM orders WHERE user_id = :user_id",
            ["user_id" => $user_id]
        );
    }

    public function insert($data) {
        return parent::add($data);
    }
}
