<?php 

require_once __DIR__ . '/../dao/UserDao.php';

class UserService {
    private $userDao;

    public function __construct() {
        $this->userDao = new UserDao();
    }

    public function login($email, $password) {
        $user = $this->userDao->get_user_by_email($email);

        if($user && $password == $user['password']) {
            return $user; // login is successfull
        }

        return null; // login is not successfull
    }

}