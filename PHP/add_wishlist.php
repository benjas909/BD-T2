<?php require 'config/database.php';
session_start();
$userid = $_SESSION['id'];
$itemid = $_GET['itemid'];
$ishotel = $_GET['ishotel'];
$prev_url = $_SERVER['HTTP_REFERER'];

echo $id . " is hotel " . $ishotel;

if ($ishotel) {
    $selquery = mysqli_query($conn, "SELECT * FROM wishlist WHERE id_hotel=$itemid AND id_user=$userid");

    if (mysqli_num_rows($selquery)) {

        if ($stmt = mysqli_prepare($conn, "DELETE FROM wishlist WHERE id_hotel=$itemid AND id_user=$userid")) {
            // mysqli_stmt_bind_param($stmt, "ii", $itemid, $userid);
            if (mysqli_stmt_execute($stmt)) {
                echo "<script> alert('Se ha removido el hotel de tu wishlist');
                               window.location = '$prev_url'
                      </script>";
                // header("location:$prev_url");
                exit();
            } else {
                echo "Error inesperado al eliminar elemento de la wishlist (Ejecución de query)";
            }

        }

    } else {

        if ($stmt = mysqli_prepare($conn, "INSERT INTO wishlist (id_user, id_hotel, ishotel) VALUES ($userid, $itemid, $ishotel)")) {
            if (mysqli_stmt_execute($stmt)) {
                echo "<script> alert('Se ha añadido el hotel a tu wishlist');
                               window.location = '$prev_url';
                      </script>";
                // header("location:$prev_url");
                exit();
            }
        }
    }
} else {
    $selquery = mysqli_query($conn, "SELECT * FROM wishlist WHERE id_pack=$itemid AND id_user=$userid");

    if (mysqli_num_rows($selquery)) {
        if ($stmt = mysqli_prepare($conn, "DELETE FROM wishlist WHERE id_pack=$itemid AND id_user=$userid")) {
            if (mysqli_stmt_execute($stmt)) {
                echo "<script> alert('Se ha removido el paquete de la wishlist');
                      window.location = '$prev_url';
                      </script>";
                exit();
            }
        }
    } else {

        if ($stmt = mysqli_prepare($conn, "INSERT INTO wishlist (id_user, id_pack, ishotel) VALUES ($userid, $itemid, $ishotel)")) {
            if (mysqli_stmt_execute($stmt)) {
                echo "<script> alert('Se ha añadido el paquete a tu wishlist');
                               window.location = '$prev_url';
                      </script>";
                exit();
            }
        }
    }
}
mysqli_close($conn);
?>