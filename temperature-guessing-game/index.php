<?php
require_once('includes/config.inc.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Semesterprojekt</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body class="startseite">

<h1 style="text-align: center; margin-top: 100px; margin-bottom:10px; font-family: PoppinsRegular, sans-serif">Temperature</h1>
<h1 style="text-align: center; margin-bottom: 20px; margin-top:0; font-size: 3em;">Guessing-Game</h1>

<div class="login-container">
    <div class="login-box">
        <h3 style="margin-top:20px; margin-bottom: 20px; font-size: 1.5em;">Login</h3>

        <form action="action.php" method="POST">

            <input type="text" name="username" placeholder="Username"><br>
            <input type="text" name="password" placeholder="Passwort"><br>
            <input type="submit" value="Login" name="Login" class="yellow-button" style="margin-top:10px; margin-bottom:20px;">

        </form>
    </div>

    <div class="register-box">
        <h3 style="margin-top: 20px; margin-bottom: 20px; font-size: 1.5em;">Registrieren</h3>

        <form action="action.php" method="POST">

            <input type="text" id="reg-username" name="username" placeholder="Username">
            <p id="reg-feedback"></p>
            <input type="text" name="password" placeholder="Passwort"><br>
            <input type="submit" value="Registrieren" name="Register" class="yellow-button" style="margin-top:10px; margin-bottom:20px;">

        </form>
    </div>
</div>

<?php
if (isset($_GET['error'])) {
    $error = $_GET['error'];

    if ($error == 1) {
        echo "<p style='text-align:center;'>Username oder Passwort falsch.</p>";
    }
    if ($error == 2) {
        echo "<p style='text-align:center;'>Kein Zugriff!</p>";
    }
    if ($error == 'userexists') {
        echo "<p style='text-align:center;'>Username existiert bereits!</p>";
    }
}

    if(isset($_GET['success']) && $_GET['success'] == '1'){
    echo "<p style='text-align:center;'>Registrierung erfolgreich!</p>";
}
?>

<script>
    $(document).ready(function(){
        $("#reg-username").blur(function(){ // Event blur wird ausgelöst, wenn man aus dem Eingabefeld draußen ist
            var username = $(this).val();

            if(username != ""){
                $.ajax({
                    url: "ajax.php",
                    method: "POST",
                    data: {check_name: username}, // ajax.php empfängt das über $_POST['check_name']
                    success: function(answer){ // in Variable answer steht das, was ajax.php mit echo ausgibt
                        $("#reg-feedback").html(answer); // schreibt die Antwort in das <p> mit der id req-feedback
                    }
                });
            } else {
                $("#reg-feedback").html("");
            }
        });
    });
</script>

</body>
</html>
