<?php
require_once('includes/config.inc.php');
session_start();

$Auth = new Auth();

if(isset($_POST['Login'])){
    $username = strip_tags(trim($_POST['username']));
    $password = $_POST['password'];

    if($Auth->checkLogin($username, $password)){
        $_SESSION['darfrein'] = true;
        $_SESSION['name'] = $username;
        header('Location: game-start.php');
    } else {
        $_SESSION['darfrein'] = false;
        header('Location: index.php?error=1');
    }
    exit;
}

if(isset($_POST['Register'])){
    $username = strip_tags(trim($_POST['username']));
    $password = $_POST['password'];

    if($Auth->registrieren($username, $password)){
        header('Location: index.php?success=1');
    } else {
        header('Location: index.php?error=userexists');
    }
    exit;
}

if(isset($_POST['Logout'])) {
    $_SESSION['darfrein'] = false;
    session_unset();
    header('Location: index.php');
    exit;
}

if(isset($_POST['Start-Game'])){
    if(isset($_SESSION['darfrein']) && $_SESSION['darfrein'] === true){
        $_SESSION['total_points'] = 0;
        $_SESSION['rounds'] = 0;
        unset($_SESSION['last_status']);
        header('Location: game-play.php');
    } else {
        header('Location: game-start.php');
    }
    exit;
}

if(isset($_POST['submit_guess'])){
        $guess = $_POST['guess'];
        $city = $_SESSION['city_to_guess'];
        $country = $_SESSION['country_to_guess'];

    $weather = new Weather();
    $realTemp = $weather->getCityTemperature($city, $country);

    if($realTemp !== null){
        $difference = abs($realTemp - $guess); // abs(), damit die Differenz immer eine positive Zahl ist

        if ($difference == 0) {
            $status = "exakt";
            $points = 100;
        } elseif ($difference <= 2) {
            $status = "sehr-nahe";
            $points = 50;
        } elseif ($difference <= 5) {
            $status = "nahe";
            $points = 20;
        } else {
            $status = "weit-daneben";
            $points = 0;
        }

        $_SESSION['last_status'] = $status;
        $_SESSION['last_temp'] = $realTemp;
        $_SESSION['total_points'] = ($_SESSION['total_points']) + $points;

        $_SESSION['rounds'] = $_SESSION['rounds'] + 1;

        if ($_SESSION['rounds'] >= 5) {
            $db = new DB();
            $userId = $_SESSION['user_id'];
            $db->saveHighscore($userId, $_SESSION['total_points']);
            header('Location: game-end.php');
        } else {
            header('Location: game-play.php');
        }
    }
    exit;
}
