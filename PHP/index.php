<?php include 'header_template.php' ?>



<!-- <div class="buttonMP">
            <a href='myprofile.php' class="button">Mi Perfil</a><br>
        </div>
        <div class="buttonLO">
            <a href='logout.php' class="button">Cerrar sesión</a><br>
        </div> -->



<div class="welcome-msg">
    <h2>Bienvenido
        <?php
        // Se muestra el nombre del usuario 
        if ($_SESSION["isloggedin"]) {
            echo "<b href='myprofile.php'>" . htmlspecialchars($_SESSION["username"]) . "</b>";
        }
        ?>

    </h2>

</div>



<h3 class="titletext">Hoteles disponibles</h3>
<?php
//$sql = "SELECT nombre, precionoche, img FROM hotel ORDER BY hab_disp DESC LIMIT 4";

$query = "
    SELECT combinacion.nombre, combinacion.img, combinacion.precio, combinacion.source, combinacion.disponibilidad
    FROM (
        SELECT nombre, img, precionoche AS precio , 'hotel' AS source, hab_disp AS disponibilidad
        FROM hotel
        UNION ALL
        SELECT nombre, img, precio_persona AS precio , 'paquete' AS source, paq_disp AS disponibilidad
        FROM paquete
    ) AS combinacion
    ORDER BY combinacion.disponibilidad DESC
    LIMIT 4
";

$result = mysqli_query($conn, $query);
// echo "<div>";
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {

        $nombre = $row['nombre'];
        $precio = $row['precio'];
        $imagen = $row['img'];
        $source= $row['source'];
        $url="info.php?source=" . urlencode($source) . "&nombre=" . urlencode($nombre);
        
        echo "<a class='hyperlink' href='$url'>";
        echo "<div class= 'card'>";
        
        echo "Nombre: $nombre<br>";

        if ($source === 'hotel') {
            echo "Precio/noche: $precio <br>";
        } elseif ($source === 'paquete') {
            echo "Precio/persona: $precio <br>";
        }
        
        echo "Imagen: <img src='$imagen' alt='Hotel Image' class='item-img'><br><br>";

        echo "</div>";
        echo "</a>";
    }
} else {

    echo "Error executing the query: " . mysqli_error($conn);
}
// echo "</div>";
?>
</div>

<?php
include 'footer_template.php';
?>