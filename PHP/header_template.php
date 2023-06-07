<?php require 'config/database.php';
session_start();

function clean_inputs($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

// Si la persona no ha iniciado sesión, se le redirecciona al login
if (!isset($_SESSION["isloggedin"]) || $_SESSION["isloggedin"] !== true) {
    // echo '<script>
    //         alert("No has iniciado sesión.");
    //         window.location = "login.php";
    //         </script>';
    header("location: login.php");
    session_destroy();
    // die();
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Prestige Travels</title>

    <link rel="stylesheet" href="../CSS/tempstyle.css">
</head>


<body>

    <div class="container">
        <div class="navbar">
        <ul>
            <li style="float:left"><a href="index.php">Home</a></li>
            <!-- <li class="logo">PRESTIGE</li> -->
            <li style="float:right"><a href="myprofile.php">
                    <?php
                    // Se muestra el nombre del usuario 
                    if ($_SESSION["isloggedin"]) {
                        echo "<b>" . htmlspecialchars($_SESSION["username"]) . "</b>";
                    }
                    ?>
                </a></li>
            <li style="float:right"><a href="logout.php">Cerrar sesión</a></li>
            <li style="float:right"><a href="cart.php">Carrito</a></li>
            <li style="float:right"><a href="advancedsearch.php">Busqueda Avanzada</a></li>
        </ul>
        </div>