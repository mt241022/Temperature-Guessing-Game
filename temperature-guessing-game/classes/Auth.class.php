<?php
require_once('DB.class.php');

class Auth {

    private $db;

    function __construct() {
        $this->db = new DB(); // damit jedes Auth-Objekt auch sofort Zugang zur DB hat
    }

    function userExists($username) {
        return $this->db->userExists($username);
    }

    function getByUsername($username) {
        return $this->db->getByUsername($username);
    }

    function registrieren($username, $password) {
        if($this->userExists($username)){
            return false;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT); // Password_Default -> dadurch nimmt php den aktuell sichersten Algorithmus, um das PW zu hashen

        $this->db->addUser($username, $passwordHash);
        return true;
    }

    function checkLogin($username, $password) {
        $user = $this->getByUsername($username);

        if($user && password_verify($password, $user['password'])){ // vergleicht die zwei Hashes
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            return true;
        }
        return false;
    }
}
