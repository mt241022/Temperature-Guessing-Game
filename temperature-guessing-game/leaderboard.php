<?php
session_start();
require_once('includes/config.inc.php');

$db = new DB();
$rankings = $db->getTopTen();

if($_SESSION['darfrein'] != true){
    header('Location: index.php?error=2');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Leaderboard</title>
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

<div class="leaderboard">
    <h1>Top 10 Spieler:innen</h1>

    <?php
    $position = 1;
    foreach ($rankings as $row):
    ?>
    <div class="rank-item">
        <div class="rank-number"><?php echo $position; ?>.</div>

        <div class="rank-name">
        <div class="name"><?php echo $row['username']; ?></div>
        <div class="score"><?php echo $row['score']; ?> Pkt</div>
        </div>
    </div>
    <?php
    $position++;
    endforeach;
    ?>
</div>

</body>
</html>
