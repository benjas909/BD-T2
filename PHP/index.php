<?php require 'config/database.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Prestige Travels - Home </title>
</head>

<body>
    <h4>Bienvenido
        <?php echo $_POST["username"]; ?>
    </h4>
    <a href="signup.php">Registrarse</a><br>
    <a href="login.php">Login</a><br>
    <a href="myprofile.php">Mi Perfil</a><br>

</body>