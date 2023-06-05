<?php include 'header_template.php' ?>

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

<h3> Busqueda: </h3>

<form action="basicsearch.php" method="GET">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre"><br><br>

        <label for="ciudad">Ciudad:</label>
        <input type="text" name="ciudad" id="ciudad"><br><br>

        <label for="fechainicio">Fecha de inicio:</label>
        <input type="text" name="fechainicio" id="fechainicio"><br><br>

        <label for="fechatermino">Fecha de termino:</label>
        <input type="text" name="fechatermino" id="fechatermino"><br><br>

        <input type="submit" value="Buscar">

<h3 class="titletext">Top Reservas disponibles</h3>
<?php

$query = "
    SELECT combinacion.id, combinacion.nombre, combinacion.img, combinacion.precio, combinacion.source, combinacion.disponibilidad
    FROM (
        SELECT id_hotel AS id, nombre, img, precionoche AS precio , 'hotel' AS source, hab_disp AS disponibilidad
        FROM hotel
        UNION ALL
        SELECT id_paquete AS id, nombre, img, precio_persona AS precio , 'paquete' AS source, paq_disp AS disponibilidad
        FROM paquete
    ) AS combinacion
    ORDER BY combinacion.disponibilidad DESC
    LIMIT 4
";

$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {

        $id = $row['id'];
        $nombre = $row['nombre'];
        $precio = $row['precio'];
        $imagen = $row['img'];
        $source = $row['source'];
        $url = "info.php?source=" . urlencode($source) . "&id=" . urlencode($id);

        echo "<a class='hyperlink' href='$url'>";
        echo "<div class= 'card'>";

        echo "Nombre: $nombre<br>";

        if ($source === 'hotel') {
            echo "Precio/noche: $$precio <br>";
        } elseif ($source === 'paquete') {
            echo "Precio/persona: $$precio <br>";
        }

        echo "Imagen: <img src='$imagen' alt='Item Image' class='item-img'><br><br>";

        echo "</div>";
        echo "</a>";
    }
} else {

    echo "Error executing the query: " . mysqli_error($conn);
}

?>
</div>

<?php
include 'footer_template.php';
?>