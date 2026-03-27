<?php
require_once('includes/config.inc.php');

$auth = new Auth();

if(isset($_POST['check_name'])){
    $name = $_POST['check_name'];

    if($auth->userExists($name)){
        echo "<p class='error'>Name bereits vergeben</p>";
    } else {
        echo "<p class='success'>Name frei</p>";
    }
}