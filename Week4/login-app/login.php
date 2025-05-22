<?php 
require_once __DIR__ . ' /service/UserService.php';

// Take the email & password from FORM 
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// pokreni login kroz Service
$userService = new UserService();
$user = $userService->login($email,$password);

if($user) {
    echo "WELCOME, " . htmlspecialchars($user['email']) . "!";
} else {
    echo "Wrong email or password...";
}

// Debugging
$dao = new \UserDao();
$realUser = $dao->get_user_by_email($email); 

if(!$realUser) {
    echo "Nema korisnika sa tim emailom";
} else {
    echo "Email iz baze: " . $realUser['email'] . "<br>";
    echo "Hashirana sifra iz baze: " . $realUser['password'] . "<br>";
    echo "Unesena sifra: " . $password . "<br>";

}