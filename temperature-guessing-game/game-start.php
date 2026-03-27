<?php
session_start();
require_once('includes/config.inc.php');

if($_SESSION['darfrein'] != true){
    header('Location: index.php?error=2');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Start</title>
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

    <div class="inhalt-start">

        <div class="text-start">
            <h1>Errate die<br> aktuelle<br> Temperatur</h1>
            <p>Gib deinen Guess zur aktuellen Temperatur in verschiedenen europäischen Hauptstädten ab.</p>
            <form action="action.php" method="POST">
                <input type ="submit" name="Start-Game" value="Start Game" class="yellow-button">
            </form>
        </div>

        <div class="img-start">
            <img src="images/winterlandschaft.webp" alt="Ansicht Winterlandschaft Norwegen">
        </div>

    </div>
</body>
</html>
