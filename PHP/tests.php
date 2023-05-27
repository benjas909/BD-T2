<?php require 'config/database.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Prestige Travels - Registrarse </title>
</head>

<body>
    <form action="tests.php" method="post">
        fecha <input type="date" name="fecha">
        <input type="submit">
    </form>

    La fecha es
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo $_POST["fecha"];
    }
    ?>
</body>