<?php include_once 'header_template.php';
?>
<br><br>
<div class="flex-container">
    <?php

    $source = $_GET['source'];
    $id = $_GET['id'];


    // echo "<div class='flex-container'>";
    if ($source === 'hotel') {
        $query = "
    SELECT nombre, ciudad, img, precionoche, estrellas, hab_totales, hab_disp, parking, piscina, lavanderia, mascotas, desayuno FROM hotel WHERE id_hotel='$id'
    ";
        $result = mysqli_query($conn, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $idciudad = $row['ciudad'];
                $cityquery = "SELECT ciudad_nombre AS nombre FROM ciudad WHERE id=$idciudad";
                $cityresult = mysqli_query($conn, $cityquery);
                if ($cityresult){
                    $cityrow = mysqli_fetch_assoc($cityresult); 
                }

                $nombre = $row['nombre'];
                $ciudad = $cityrow['nombre'];
                $imagen = $row['img'];
                $precionoche = $row['precionoche'];
                $estrellas = $row['estrellas'];
                $hab_totales = $row['hab_totales'];
                $hab_disp = $row['hab_disp'];
                $parking = $row['parking'];
                $piscina = $row['piscina'];
                $lavanderia = $row['lavanderia'];
                $mascotas = $row['mascotas'];
                $desayuno = $row['desayuno'];
                $ishotel = 1;

                echo "<div class='image'>
                    <img src='$imagen' alt='$nombre'>
                  </div>";
                echo "<div class='info'>";
                echo "<h3>$nombre</h3>";
                echo "<p>Ciudad: $ciudad</p>";
                echo "<p>Precio por noche: $$precionoche</p>";
                echo "<p>Estrellas: $estrellas</p>";
                echo "<p>Habitaciones disponibles: $hab_disp/$hab_totales</p>";
                echo "<p>Parking: " . ($parking ? 'Sí' : 'No') . "</p>";
                echo "<p>Piscina: " . ($piscina ? 'Sí' : 'No') . "</p>";
                echo "<p>Lavandería: " . ($lavanderia ? 'Sí' : 'No') . "</p>";
                echo "<p>Mascotas: " . ($mascotas ? 'Sí' : 'No') . "</p>";
                echo "<p>Desayuno: " . ($desayuno ? 'Sí' : 'No') . "</p>";
                echo "</div>";
                // echo "<div>";
                // echo "<a href='add_wishlist.php?itemid=$id&ishotel=$ishotel'>Agregar a wishlist</a>";
                // echo "<a href=''>Agregar al carrito</a>";
    
            }

        } else {
            echo "Error executing the query: " . mysqli_error($conn);
        }

    } elseif ($source === 'paquete') {
        $query = "
    SELECT nombre, img, aero_ida, aero_vuelta, f_salida, f_llegada, DATEDIFF(f_llegada, f_salida) AS noches_totales, precio_persona, paq_disp, paq_totales, max_personas , id_hospedajes, id_ciudades FROM paquete WHERE id_paquete='$id'
    ";
        $result = mysqli_query($conn, $query);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $nombre = $row['nombre'];
                $imagen = $row['img'];
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
                $ishotel = 0;

                echo "<div class='image'>
                    <img src='$imagen' alt='$nombre'>
                  </div>";
                echo "<div class='info'>";
                echo "<h3>$nombre</h3>";
                echo "<p>Aeropuerto (Ida): $aero_ida</p>";
                echo "<p>Aeropuerto (Vuelta): $aero_vuelta</p>";
                echo "<p>Fecha de Salida: $f_salida</p>";
                echo "<p>Fecha de Llegada: $f_llegada</p>";
                echo "<p>Noches Totales: $noches_totales</p>";
                echo "<p>Precio por Persona: $$precio_persona</p>";
                echo "<p>Disponibilidad: $paq_disp/$paq_totales</p>";
                echo "<p>Máximo de Personas: $max_personas</p>";
                echo "</div>";

            }
        } else {
            echo "Error executing the query: " . mysqli_error($conn);
        }
    }
    echo "<div class='addto'>";
    echo "<a href='add_wishlist.php?itemid=$id&ishotel=$ishotel'>Agregar/Quitar de wishlist</a><br>";
    echo "<a href='add_cart.php?itemid=$id&ishotel=$ishotel'>Agregar al carrito</a>";
    echo "</div>";
    ?>
</div>
</div>

<?php include 'footer_template.php';