<?php include 'header_template.php';
?>
<h3> Busqueda: </h3>

<form action="" method="GET">
    <label for="precio">Precio:</label>
    <input type="text" name="precio" id="precio"><br><br>

    <label for="ciudad">Ciudad:</label>
    <input type="text" name="ciudad" id="ciudad"><br><br>

    <label for="calificacionminima">Calificación mínima</label>
    <input type="text" name="calificacionminima" id="calificacionminima"><br><br>
    
    <label for="paquete">Solo paquetes:</label>
    <input type="checkbox" id="paquete" name="paquete" value="1"><br><br>

    <label for="hotel">Solo hoteles:</label>
    <input type="checkbox" id="hotel" name="hotel" value="1"><br><br>

    <input type="submit" name="Buscar" value="Buscar">

<?php

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['Buscar'])) {
        $precio = $_GET['precio'];
        $calificacionminima = $_GET['calificacionminima'];
        $ciudad = $_GET['ciudad'];

        $query = "
        SELECT combinacion.id, combinacion.nombre, combinacion.img, combinacion.precio, combinacion.source, combinacion.estrellas
        FROM (
            SELECT id_hotel AS id, nombre, img, precionoche AS precio, 'hotel' AS source, estrellas
            FROM hotel
            LEFT JOIN ciudad ON hotel.ciudad = ciudad.id
            WHERE 1=1"
            . ($ciudad ? " AND ciudad_nombre LIKE '%$ciudad%'" : "")
            . "
            UNION ALL
            SELECT id_paquete AS id, nombre, img, precio_persona AS precio, 'paquete' AS source, 0 AS estrellas
            FROM paquete
            LEFT JOIN grupo_ciudades on paquete.id_ciudades = grupo_ciudades.id_grupo
            LEFT JOIN ciudad c1 on grupo_ciudades.id_ciudad1 = c1.id
            LEFT JOIN ciudad c2 on grupo_ciudades.id_ciudad1 = c2.id
            LEFT JOIN ciudad c3 on grupo_ciudades.id_ciudad1 = c3.id
            WHERE 1=1"
            . ($ciudad ? " AND (c1.ciudad_nombre LIKE '%$ciudad%' OR c2.ciudad_nombre LIKE '%$ciudad%' OR c3.ciudad_nombre LIKE '%$ciudad%')" : "")
        . ") combinacion
        WHERE 1=1";

        if (!empty($precio)) {
            $query .= " AND combinacion.precio <= $precio";
        }
        
        if (!empty($calificacionminima)) {
            $query .= " AND combinacion.estrellas >= $calificacionminima";
        }
        
        if (isset($_GET['paquete'])) {
            $query .= " AND combinacion.source = 'paquete' ";
        } 

        if (isset($_GET['hotel'])) {
            $query .= " AND combinacion.source = 'hotel'";
        }  




        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) { 
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
            echo "<br>No hay resultados";
        }
    }
}

?>