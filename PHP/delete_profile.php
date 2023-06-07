<?php include 'header_template.php';


$id = $_SESSION["id"];

mysqli_query($conn, "DELETE FROM users WHERE id=$id");

header("location:logout.php");

include 'footer_template.php' ?>

