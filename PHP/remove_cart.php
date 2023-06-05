<?php require 'config/database.php';
session_start();
$userid = $_SESSION['id'];
$itemid = $_GET['itemid'];
$ishotel = $_GET['ishotel'];
$prev_url = $_SERVER['HTTP_REFERER'];

if ($ishotel) {
    $selquery = mysqli_query($conn, "SELECT * FROM cart WHERE id_hotel=$itemid AND id_user=$userid");
    $row = mysqli_fetch_assoc($selquery);
    if ($row['quant'] > 1) {

        if ($stmt = mysqli_prepare($conn, "UPDATE cart SET quant = quant - 1 WHERE id_hotel=$itemid AND id_user=$userid")) {

            if (mysqli_stmt_execute($stmt)) {
                header("location:$prev_url");
                exit();
            } else {
                echo "Error inesperado al agregar elemento al carrito (Ejecución de query)";

            }
        }
    } else {
        if ($stmt = mysqli_prepare($conn, "DELETE FROM cart WHERE id_hotel=$itemid")) {
            if (mysqli_stmt_execute($stmt)) {
                header("location:$prev_url");
                exit();
            }
        }
    }
} else {
    $selquery = mysqli_query($conn, "SELECT * FROM cart WHERE id_pack=$itemid AND id_user=$userid");
    $row = mysqli_fetch_assoc($selquery);
    if ($row['quant'] > 1) {

        if ($stmt = mysqli_prepare($conn, "UPDATE cart SET quant = quant - 1 WHERE id_pack=$itemid AND id_user=$userid")) {

            if (mysqli_stmt_execute($stmt)) {
                
                header("location:$prev_url");
                exit();
            } else {
                echo "Error inesperado al agregar elemento al carrito (Ejecución de query)";

            }
        }
    } else {
        if ($stmt = mysqli_prepare($conn, "DELETE FROM cart WHERE id_pack=$itemid")) {
            if (mysqli_stmt_execute($stmt)) {
                
                header("location:$prev_url");
                exit();
            }
        }
    }
}