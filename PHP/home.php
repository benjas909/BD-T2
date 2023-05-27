<?php require 'config/database.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prestige Travels - Home </title>
</head>
<body>
    <h3>Hoteles disponibles</h3>
    <?php
    $sql = "SELECT nombre, precionoche, img FROM hotel ORDER BY hab_disp DESC LIMIT 4";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $nombre = $row['nombre'];
            $precio = $row['precionoche'];
            $imagen = $row['img'];
            echo "Name: $nombre<br>";
            echo "Price per Night: $precio<br>";
            echo "Image: <img src='$imagen' alt='Hotel Image'><br><br>";
        }
    } else {
   
        echo "Error executing the query: " . mysqli_error($connection);
    }
    ?>