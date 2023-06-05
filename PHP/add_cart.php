<?php require 'config/database.php';
session_start();
$userid = $_SESSION['id'];
$itemid = $_GET['itemid'];
$ishotel = $_GET['ishotel'];
$prev_url = $_SERVER['HTTP_REFERER'];

if ($ishotel) {
    $selquery = mysqli_query($conn, "SELECT * FROM cart WHERE id_hotel=$itemid AND id_user=$userid");

    if (mysqli_num_rows($selquery)) {

        if ($stmt = mysqli_prepare($conn, "UPDATE cart SET quant = quant + 1 WHERE id_hotel=$itemid AND id_user=$userid")) {

            if (mysqli_stmt_execute($stmt)) {
                echo "<script> alert('Se ha añadido el hotel al carrito');
                               window.location = '$prev_url'
                      </script>";
                // header("location:$prev_url");
                exit();
            } else {
                echo "Error inesperado al agregar elemento al carrito (Ejecución de query)";

            }
        }
    } else {
        if ($stmt = mysqli_prepare($conn, "INSERT INTO cart (id_user, id_hotel, ishotel, quant) VALUES ($userid, $itemid, $ishotel, 1)")) {
            if (mysqli_stmt_execute($stmt)) {
                echo "<script> alert('Se ha añadido el hotel a al carrito');
                               window.location = '$prev_url';
                      </script>";
                // header("location:$prev_url");
                exit();
            }
        }
    }
} else {
    $selquery = mysqli_query($conn, "SELECT * FROM cart WHERE id_pack=$itemid AND id_user=$userid");

    if (mysqli_num_rows($selquery)) {

        if ($stmt = mysqli_prepare($conn, "UPDATE cart SET quant = quant + 1 WHERE id_pack=$itemid AND id_user=$userid")) {

            if (mysqli_stmt_execute($stmt)) {
                echo "<script> alert('Se ha añadido el paquete al carrito');
                               window.location = '$prev_url'
                      </script>";
                // header("location:$prev_url");
                exit();
            } else {
                echo "Error inesperado al agregar elemento al carrito (Ejecución de query)";

            }
        }
    } else {
        if ($stmt = mysqli_prepare($conn, "INSERT INTO cart (id_user, id_pack, ishotel, quant) VALUES ($userid, $itemid, $ishotel, 1)")) {
            if (mysqli_stmt_execute($stmt)) {
                echo "<script> alert('Se ha añadido el paquete a al carrito');
                               window.location = '$prev_url';
                      </script>";
                // header("location:$prev_url");
                exit();
            }
        }
    }
}
// mysqli_close($conn);

?>