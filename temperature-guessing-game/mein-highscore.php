<?php
session_start();
require_once('includes/config.inc.php');

$db = new DB();
$userId = $_SESSION['user_id'];
$highscore = $db->getHighscoreById($userId);

if($_SESSION['darfrein'] != true){
    header('Location: index.php?error=2');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mein Highscore</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="navigation">
    <form action="action.php" method="POST" class="logout-button">
        <input type ="submit" name="Logout" value="Logout">
    </form>
    <a href="game-start.php">Startseite</a>
    <a href="mein-highscore.php">Mein Highscore</a>
    <a href="leaderboard.php">Leaderboard</a>
</div>

<div class="highscore-content">
    <h3><?= $_SESSION['name']?>s Highscore:</h3>
<p class="highlight-highscore">
    <?php if(isset($highscore['score'])){
    echo $highscore['score'];
    } else {
    echo 0;
    }
    ?>
    Punkte</p>
</div>
</body>
</html>
