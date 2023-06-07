<?php include 'header_template.php';

echo $_SESSION["username"];

$id = $_SESSION["id"];

if ($stmt = mysqli_prepare($conn, "SELECT email, birthday FROM users WHERE id = ?")) {
    mysqli_stmt_bind_param($stmt, "s", $id);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);

        mysqli_stmt_bind_result($stmt, $email, $birthday);

        if (mysqli_stmt_fetch($stmt)) {
            echo "email: " . $email . "<br>";
            echo "Fecha de Nacimiento: " . $birthday . "<br>";
        }
    }
} else {
    echo "Error de query, revisar.";
}

?>

<a href="wishlist.php">Mi Wishlist</a>
<h3> Reseñas de hoteles: </h3>
<?php
    $query = "
    SELECT id_hotel,limpieza,servicio,deco,camas,reseña FROM hotel_review WHERE id_user = $id
    ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0){ 
        while ($row = mysqli_fetch_assoc($result)) {
            $id_hotel = $row['id_hotel'];
            $limpieza = $row['limpieza'];
            $servicio = $row['servicio'];
            $deco = $row['deco'];
            $camas = $row['camas'];
            $reseña = $row['reseña'];
            $source = 'hotel';
            $url = "info.php?source=" . urlencode($source) . "&id=" . urlencode($id_hotel);

            $query = "
            SELECT nombre,img FROM hotel WHERE id_hotel = $id_hotel
            ";

            $result2 = mysqli_query($conn, $query);
            if (mysqli_num_rows($result2) > 0){ 
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $nombre = $row2['nombre'];
                    $imagen = $row2['img'];
                    echo "<a class='hyperlink' href='$url'>";
                    echo "Nombre: $nombre<br>";
                    echo "<img src='$imagen' alt='Item Image' class='item-img'><br><br>";
                    echo "</a>";
                }

            }
            echo "Limpieza: $limpieza/5<br>";
            echo "Servicio: $servicio/5<br>";
            echo "Decoración: $deco/5<br>";
            echo "Camas: $camas/5<br>";
            echo "Reseña: $reseña";
            echo "<br><br>";
        }
    } else {
        echo "No hay resultados";
    }
    

?>

<h3> Reseñas de paquetes: </h3>

<?php
    $query = "
    SELECT id_pack,cal_hoteles,cal_transport,cal_servicio,rel_calprecio,reseña FROM package_review WHERE id_user = $id
    ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0){ 
        while ($row = mysqli_fetch_assoc($result)) {
            $id_pack = $row['id_pack'];
            $cal_hoteles = $row['cal_hoteles'];
            $cal_transport = $row['cal_transport'];
            $cal_servicio = $row['cal_servicio'];
            $rel_calprecio = $row['rel_calprecio'];
            $reseña = $row['reseña'];
            $source = 'paquete';
            $url = "info.php?source=" . urlencode($source) . "&id=" . urlencode($id_pack);

            $query = "
            SELECT nombre,img FROM paquete WHERE id_paquete = $id_pack
            ";
            
            $result2 = mysqli_query($conn, $query);
            if (mysqli_num_rows($result2) > 0){ 
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $nombre = $row2['nombre'];
                    $imagen = $row2['img'];
                    echo "<a class='hyperlink' href='$url'>";
                    echo "Nombre: $nombre<br>";
                    echo "<img src='$imagen' alt='Item Image' class='item-img'><br><br>";
                    echo "</a>";
                }

            }
            echo "Calificación hoteles: $cal_hoteles/5<br>";
            echo "Transporte: $cal_transport/5<br>";
            echo "Servicio: $cal_servicio/5<br>";
            echo "Precio: $rel_calprecio/5<br>";
            echo "Reseña: $reseña";
            echo "<br><br>";
        }
    } else {
        echo "No hay resultados";
    }
    

?>
<?php
include 'footer_template.php';
?>