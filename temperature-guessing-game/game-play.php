<?php
session_start();
require_once('includes/config.inc.php');

if($_SESSION['darfrein'] != true){
    header('Location: index.php?error=2');
    exit();
}

$db = new DB();

if (isset($_GET['new_round'])) {
    unset($_SESSION['last_status']);
    unset($_SESSION['last_temp']);
    unset($_SESSION['city_to_guess']);
    unset($_SESSION['country_to_guess']);

    header('Location: game-play.php');
    exit;
}
if (!isset($_SESSION['city_to_guess'])) {
    $city = $db->getRandomCity();
    if ($city) {
        $_SESSION['city_to_guess'] = $city['city_name'];
        $_SESSION['country_to_guess'] = $city['country_code'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Play</title>
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

<div class="game-content">
<?php
if (isset($_SESSION['last_status'])) {
    ?>
    <div class="feedback-box <?php echo $_SESSION['last_status']; ?>">

        <?php if ($_SESSION['last_status'] == "exakt"): ?>
            <h2>Wowi!</h2>
            <p>Es sind genau <strong><?php echo $_SESSION['last_temp']; ?>°C</strong>.</p>
            <p>+100 Pkt.</p>

        <?php elseif ($_SESSION['last_status'] == "sehr-nahe"): ?>
            <h2>Fast perfekt!</h2>
            <p>Es sind <strong><?php echo $_SESSION['last_temp']; ?>°C</strong>.</p>
            <p>+50 Pkt.</p>

        <?php elseif ($_SESSION['last_status'] == "nahe"): ?>
            <h2>Guter Tipp!</h2>
            <p>Es sind <strong><?php echo $_SESSION['last_temp']; ?>°C</strong>.</p>
            <p>+20 Pkt.</p>

        <?php else: ?>
            <h2>Leider weit daneben :(</h2>
            <p>Es sind <strong><?php echo $_SESSION['last_temp']; ?>°C</strong>.</p>
        <?php endif; ?>

        <p class="score-display">Punktestand: <?php echo ($_SESSION['total_points']); ?></p>
        <a href="game-play.php?new_round" class="yellow-button">Nächste Runde</a>
    </div>
    <?php
}
else {
?>
    <p>
        Wie warm ist es gerade in<br>
        <span class="highlight-city"><?php echo htmlspecialchars($_SESSION['city_to_guess']); ?>?</span>
    </p>

    <div>
        <form action="action.php" method="POST">
            <input type="number" name="guess" step="0.01" placeholder="Dein Guess" required> <!--step 0.01 erlaubt zwei Nachkommastellen -->
            <button type="submit" name="submit_guess" class="yellow-button">Submit</button>
        </form>
    </div>
    <?php
}
?>
</div>

</body>
</html>
