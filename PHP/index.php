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

<?php

$num = rand(1, 5);

if ($num == 5) {
    echo "<div class='disc-banner'>
          <h3>¡SOLO PARA TI! 10% DE DESCUENTO EN TU PRÓXIMA COMPRA.</h3>
          <h4>Para canjearlo, haz click <a href='canje_cupon.php'>aquí</a></h4>
          </div>";
}
?>

<h3> Busqueda: </h3>

<form action="basicsearch.php" method="GET">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre"><br><br>

        <label for="ciudad">Ciudad:</label>
        <input type="text" name="ciudad" id="ciudad"><br><br>

        <label for="fechainicio">Fecha de inicio:</label>
        <input type="text" name="fechainicio" id="fechainicio" placeholder="aaaa-mm-dd"><br><br>

        <label for="fechatermino">Fecha de termino:</label>
        <input type="text" name="fechatermino" id="fechatermino" placeholder="aaaa-mm-dd" ><br><br>

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

<h3 class="titletext"> Top 10 hoteles </h3>

<?php

    $query = "
    SELECT nombre,img,calif_promedio FROM hotel ORDER BY calif_promedio DESC
    LIMIT 10
    ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0){ 
        while ($row = mysqli_fetch_assoc($result)) {
            $nombre = $row['nombre'];
            $imagen = $row['img'];
            $calif_promedio = $row['calif_promedio'];

            $source = 'hotel';
            $url = "info.php?source=" . urlencode($source) . "&id=" . urlencode($id);
            echo "<a class='hyperlink' href='$url'>";
            echo "<div class= 'card'>";

            echo "Nombre: $nombre<br>";
            echo "Imagen: <img src='$imagen' alt='Item Image' class='item-img'><br><br>";
            echo "Puntuación: $calif_promedio/5";

            echo "</div>";
            echo "</a>";
        }
    }

?>

<h3 class="titletext"> Top 10 paquetes </h3>

<?php

    $query = "
    SELECT nombre,img,calif_promedio FROM paquete ORDER BY calif_promedio DESC
    LIMIT 10
    ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0){ 
        while ($row = mysqli_fetch_assoc($result)) {
            $nombre = $row['nombre'];
            $imagen = $row['img'];
            $estrellas = $row['calif_promedio'];

            $source = 'paquete';
            $url = "info.php?source=" . urlencode($source) . "&id=" . urlencode($id);
            echo "<a class='hyperlink' href='$url'>";
            echo "<div class= 'card'>";

            echo "Nombre: $nombre<br>";
            echo "Imagen: <img src='$imagen' alt='Item Image' class='item-img'><br><br>";
            echo "Puntuación: $estrellas/5";

            echo "</div>";
            echo "</a>";
        }
    }

?>
</div>

<?php
include 'footer_template.php';
?>