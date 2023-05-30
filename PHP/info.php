<?php include 'header_template.php';
?>

<?php

$source=$_GET['source'];
$nombre=$_GET['nombre'];

if ($source === 'hotel') {
    $query = "
    SELECT nombre, ciudad, precionoche, estrellas, hab_totales, hab_disp, parking, piscina, lavanderia, mascotas, desayuno FROM hotel WHERE nombre='$nombre'
    ";
    $result = mysqli_query($conn, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $nombre = $row['nombre'];
            $ciudad = $row['ciudad'];
            $precionoche = $row['precionoche'];
            $estrellas = $row['estrellas'];
            $hab_totales = $row['hab_totales'];
            $hab_disp = $row['hab_disp'];
            $parking = $row['parking'];
            $piscina = $row['piscina'];
            $lavanderia = $row['lavanderia'];
            $mascotas = $row['mascotas'];
            $desayuno = $row['desayuno'];
    
            echo "<div class='hotel'>";
            echo "<h3>$nombre</h3>";
            echo "<p>Ciudad: $ciudad</p>";
            echo "<p>Precio por noche: $precionoche</p>";
            echo "<p>Estrellas: $estrellas</p>";
            echo "<p>Habitaciones: $hab_disp/$hab_totales</p>";
            echo "<p>Parking: " . ($parking ? 'Sí' : 'No') . "</p>";
            echo "<p>Piscina: " . ($piscina ? 'Sí' : 'No') . "</p>";
            echo "<p>Lavandería: " . ($lavanderia ? 'Sí' : 'No') . "</p>";
            echo "<p>Mascotas: " . ($mascotas ? 'Sí' : 'No') . "</p>";
            echo "<p>Desayuno: " . ($desayuno ? 'Sí' : 'No') . "</p>";
            echo "</div>";
        }

    } else {
        echo "Error executing the query: " . mysqli_error($conn);
    }

} elseif ($source === 'paquete') {
    $query="
    SELECT nombre, aero_ida, aero_vuelta, f_salida, f_llegada, noches_totales, precio_persona, paq_disp, paq_totales, max_personas , id_hospedajes, id_ciudades FROM paquete WHERE nombre='$nombre'
    ";
    $result = mysqli_query($conn, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {   
            $nombre = $row['nombre'];
            $aero_ida = $row['aero_ida'];
            $aero_vuelta = $row['aero_vuelta'];
            $f_salida = $row['f_salida'];
            $f_llegada = $row['f_llegada'];
            $noches_totales = $row['noches_totales'];
            $precio_persona = $row['precio_persona'];
            $paq_disp = $row['paq_disp'];
            $paq_totales = $row['paq_totales'];
            $max_personas = $row['max_personas'];
            $id_hospedajes = $row['id_hospedajes'];
            $id_ciudades = $row['id_ciudades'];

            echo "<div class='info'>";
            echo "<h3>$nombre</h3>";
            echo "<p>Aeropuerto (Ida): $aero_ida</p>";
            echo "<p>Aeropuerto (Vuelta): $aero_vuelta</p>";
            echo "<p>Fecha de Salida: $f_salida</p>";
            echo "<p>Fecha de Llegada: $f_llegada</p>";
            echo "<p>Noches Totales: $noches_totales</p>";
            echo "<p>Precio por Persona: $precio_persona</p>";
            echo "<p>Disponibilidad: $paq_totales/$paq_disp</p>";
            echo "<p>Máximo de Personas: $max_personas</p>";
            echo "</div>";
        }
    } else {
        echo "Error executing the query: " . mysqli_error($conn);
    } 
}
?>
