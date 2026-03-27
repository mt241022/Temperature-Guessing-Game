<?php
session_start();
require_once('includes/config.inc.php');

if($_SESSION['darfrein'] != true){
    header('Location: index.php?error=2');
    exit();
}

$db = new DB();
$userId = $_SESSION['user_id'];
$highscore = $db->getHighscoreById($userId);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game End</title>
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

<?php
if (isset($_SESSION['total_points'])) {
    ?>
    <div class="endpoints">
        <?php if (isset($_SESSION['last_status'])): ?>
            <div class="feedback-box <?php echo $_SESSION['last_status']; ?>">
                <?php if ($_SESSION['last_status'] == "exakt"): ?>
                    <h2>Wowi!</h2>
                    <p>Es waren genau <strong><?php echo $_SESSION['last_temp']; ?>°C</strong>.</p>

                <?php elseif ($_SESSION['last_status'] == "sehr-nahe"): ?>
                    <h2>Fast perfekt!</h2>
                    <p>Es waren <strong><?php echo $_SESSION['last_temp']; ?>°C</strong>.</p>

                <?php elseif ($_SESSION['last_status'] == "nahe"): ?>
                    <h2>Guter Tipp!</h2>
                    <p>Es waren <strong><?php echo $_SESSION['last_temp']; ?>°C</strong>.</p>

                <?php else: ?>
                    <h2>Leider weit daneben :(</h2>
                    <p>Es waren <strong><?php echo $_SESSION['last_temp']; ?>°C</strong>.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <p class="highlight-highscore">Du hast: <?php echo ($_SESSION['total_points']); ?> Punkte erreicht</p>
        <p> Dein Highscore: <?php echo $highscore['score']; ?> Punkte</p>
        <div class="button-wrapper">
        <form action="action.php" method="post">
            <input type="submit" name="Start-Game" value="Nochmal spielen" class="yellow-button">
        </form>
        <a href="game-start.php" class="yellow-button">Zurück zur Startseite</a>
        </div>
    </div>
<?php } ?>
</body>
</html>
