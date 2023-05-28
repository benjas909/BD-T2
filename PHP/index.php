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
$sql = "SELECT nombre, precionoche, img FROM hotel ORDER BY hab_disp DESC LIMIT 4";
$result = mysqli_query($conn, $sql);
// echo "<div>";
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class= 'card'>";
        $nombre = $row['nombre'];
        $precio = $row['precionoche'];
        $imagen = $row['img'];
        echo "Nombre: $nombre<br>";
        echo "Precio/Noche: $$precio<br>";
        echo "Imagen: <img src='$imagen' alt='Hotel Image' class='item-img'><br><br>";
        echo "</div>";
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