<?php require 'config/database.php';
session_start();

if (!isset($_SESSION["isloggedin"]) || $_SESSION["isloggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Prestige Travels - Home </title>
</head>

<body>


    <h3>Bienvenido
        <?php
        if ($_SESSION["isloggedin"]) {
            echo "<b>" . htmlspecialchars($_SESSION["username"]) . "</b>";
        }
        ?>

    </h3>
    <a href='myprofile.php'>Mi Perfil</a><br>
    <a href='logout.php'>Cerrar sesión</a><br>

</body>