<?php include 'header_template.php';
// session_start();


$nombre=$_GET['nombre'];
$ciudad=$_GET['ciudad'];
$fechainicio=$_GET['fechainicio'];
$fechatermino=$_GET['fechatermino'];

$query = "
SELECT combinacion.id, combinacion.nombre, combinacion.img, combinacion.precio, combinacion.source
FROM (
    SELECT id_hotel AS id, nombre, img, precionoche AS precio, 'hotel' AS source
    FROM hotel
    LEFT JOIN ciudad ON hotel.ciudad = ciudad.id
    WHERE 1=1"
    . ($fechainicio || $fechatermino ? "1=1" : "1=0")
    . ($nombre ? " AND nombre LIKE '%$nombre%'" : "")
    . ($ciudad ? " AND ciudad_nombre LIKE '%$ciudad%'" : "")
    . "
    UNION ALL
    SELECT id_paquete AS id, nombre, img, precio_persona AS precio, 'paquete' AS source
    FROM paquete
    LEFT JOIN grupo_ciudades on paquete.id_ciudades = grupo_ciudades.id_grupo
    LEFT JOIN ciudad c1 on grupo_ciudades.id_ciudad1 = c1.id
    LEFT JOIN ciudad c2 on grupo_ciudades.id_ciudad1 = c2.id
    LEFT JOIN ciudad c3 on grupo_ciudades.id_ciudad1 = c3.id
    WHERE 1=1"
    . ($fechainicio ? " AND f_salida>='$fechainicio'" : "")
    . ($fechatermino ? " AND f_llegada<='$fechatermino'" : "")
    . ($nombre ? " AND nombre LIKE '%$nombre%'" : "")
    . ($ciudad ? " AND (c1.ciudad_nombre LIKE '%$ciudad%' OR c2.ciudad_nombre LIKE '%$ciudad%' OR c3.ciudad_nombre LIKE '%$ciudad%')": "")
    . "
) AS combinacion";

if (!empty($nombre) || !empty($ciudad) || !empty($fechainicio) || !empty($fechatermino)) {
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
        echo "No hay resultados";
    }
} else {
    echo "Filtros vacios";
}




?>

<?php include 'footer_template.php';