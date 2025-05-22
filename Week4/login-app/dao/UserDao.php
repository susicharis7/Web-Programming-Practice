<?php 
require_once __DIR__ . '/BaseDao.php';

class UserDao extends BaseDao {

    public function __construct() {
        parent::__construct("users");  // govori bazi da radimo nad tabelom "users"
    }

    // Fetch user by email
    public function get_user_by_email($email) {
        return $this->query_unique(
            "SELECT * FROM users WHERE email = :email",
            ["email" => $email]
        );
    }

}