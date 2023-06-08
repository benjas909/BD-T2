<?php include_once 'header_template.php';
?>
<br><br>
<div class="flex-container">
    <?php

    $userid = $_SESSION['id'];
    $source = $_GET['source'];
    $itemid = $_GET['id'];


    // echo "<div class='flex-container'>";
    if ($source === 'hotel') {
        $query = "
    SELECT nombre, ciudad, img, precionoche, estrellas, hab_totales, hab_disp, parking, piscina, lavanderia, mascotas, desayuno FROM hotel WHERE id_hotel='$itemid'
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
    SELECT nombre, img, aero_ida, aero_vuelta, f_salida, f_llegada, DATEDIFF(f_llegada, f_salida) AS noches_totales, precio_persona, paq_disp, paq_totales, max_personas , id_hospedajes, id_ciudades FROM paquete WHERE id_paquete='$itemid'
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
    echo "<a href='add_wishlist.php?itemid=$itemid&ishotel=$ishotel'>Agregar/Quitar de wishlist</a><br>";
    echo "<a href='add_cart.php?itemid=$itemid&ishotel=$ishotel'>Agregar al carrito</a>";
    echo "</div>";
    ?>
</div>
<br>
<div class="review">
    <?php

        $obligError = "Este campo es obligatorio.";
        $limpError = $servError = $decoError = $camaError = $commError = '';
        $limp = $serv = $deco = $camas = $comment = '';
        $c_hotelError = $c_tranError = $c_servError = $caliprecioError = $commError = '';
        $calihotel = $calitran = $caliserv = $caliprec = $comment = '';


        if($_SERVER['REQUEST_METHOD'] == 'POST'){


            if($source == 'hotel'){

                if($_POST['limpieza'] == '-') {
                    $limpError = $obligError;
                } else {
                    $limp = $_POST['limpieza'];
                } 
                
                if($_POST['servicio'] == '-') {
                    $servError = $obligError;
                } else {
                    $serv = $_POST['servicio'];
                } 
                
                if($_POST['decoracion'] == '-'){
                    $decoError = $obligError;
                } else{
                    $deco = $_POST['decoracion'];
                } 
                
                if($_POST['camas'] == '-') {
                    $camaError = $obligError;
                } else {
                    $camas = $_POST['camas'];
                } 
                
                if(empty($_POST['comment'])){
                    $commError = 'El comentario es obligatorio';
                } else {
                    $comment = clean_inputs($_POST['comment']);
                }
                
                if (empty($limpError && empty($servError) && empty($decoError) && empty(($camaError) && empty($commError)))){

                    if ($stmt = mysqli_prepare($conn, "INSERT INTO hotel_review (id_user, id_hotel, limpieza, servicio, deco, camas, reseña,review_promedio) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {
                        mysqli_stmt_bind_param($stmt, "ssssssss", $param_userid, $param_itemid, $param_limp, $param_serv, $param_deco, $param_camas, $param_comment,$param_promedio);
                        $param_userid = $userid;
                        $param_itemid = $itemid;
                        $param_limp = $limp;
                        $param_serv = $serv;
                        $param_deco = $deco;
                        $param_camas = $camas;
                        $param_comment = $comment;
                        $param_promedio = ($limp + $serv + $deco + $camas)/4;
                        try {
                            mysqli_stmt_execute($stmt);
                            header("location: " . htmlspecialchars($_SERVER['PHP_SELF']) . "?source=$source&id=$itemid");
                        } catch (mysqli_sql_exception $e) {
                            // Atrapar excepción
                            echo "<h3>Error al enviar reseña: " . $e->getMessage() . "</h3>";
                        }
                        mysqli_stmt_close($stmt);
                        
                        
                    }
                }
            } else {
                

                if($_POST['cali_hoteles'] == '-') {
                    $c_hotelError = $obligError;
                } else {
                    $calihotel = $_POST['cali_hoteles'];
                }

                if($_POST['cali_transport'] == '-') {
                    $c_tranError = $obligError;
                } else {
                    $calitran = $_POST['cali_transport'];
                }

                if($_POST['cali_servicio'] == '-') {
                    $c_servError = $obligError;
                } else {
                    $caliserv = $_POST['cali_servicio'];
                }

                if($_POST['caliprecio'] == '-') {
                    $caliprecioError = $obligError;
                } else {
                    $caliprec = $_POST['caliprecio'];
                }

                if(empty($_POST['comment'])) {
                    $commError = "El comentario es obligatorio";
                } else {
                    $comment = clean_inputs($_POST['comment']);
                }

                if(empty($c_hotelError) && empty($c_tranError) && empty($c_servError) && empty($caliprecioError) && empty($commError)) {

                    if($stmt = mysqli_prepare($conn, "INSERT INTO package_review (id_user, id_pack, cal_hoteles, cal_transport, cal_servicio, rel_calprecio, reseña,review_promedio) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {
                        mysqli_stmt_bind_param($stmt, "ssssssss", $param_userid, $param_itemid, $param_chotel, $param_ctran, $param_cserv, $param_calipr, $param_comment, $param_promedio);

                        $param_userid = $userid;
                        $param_itemid = $itemid;
                        $param_chotel = $calihotel;
                        $param_ctran = $calitran;
                        $param_cserv = $caliserv;
                        $param_calipr = $caliprec;
                        $param_comment = $comment;
                        $param_promedio = ($calihotel + $calitran + $caliserv + $caliprec)/4;


                        try {
                            mysqli_stmt_execute($stmt);
                            header("location: " . htmlspecialchars($_SERVER['PHP_SELF']) . "?source=$source&id=$itemid");

                        } catch (mysqli_sql_exception $e) {
                            echo "<h3>Error al enviar reseña: " . $e->getMessage() . "</h3>";
                        }
                        mysqli_stmt_close($stmt);
                        
                    }
                }



            }
        }
            

        echo "<h3>Ya has comprado/reservado este " . (($source == 'hotel') ? "hotel" : "paquete") . "? Deja una reseña!";

        if($source == 'hotel') {
            echo "<form method='post' action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "?source=$source&id=$itemid'>";
            echo "<p><span class='error'>* Campo obligatorio</span></p><br>";
            echo "<label for='limp'>Limpieza: </label>
            <select name='limpieza' id='limp'>
            <option value = '-'>-</option>
            <option value = '1'>1</option>
            <option value = '2'>2</option>
            <option value = '3'>3</option>
            <option value = '4'>4</option>
            <option value = '5'>5</option>
            </select> *<br>
            <span class='error'>$limpError</span>
            <br>";

            echo "<label for='serv'>Calidad del servicio: </label>
            <select name='servicio' id='serv'>
            <option value = '-'>-</option>
            <option value = '1'>1</option>
            <option value = '2'>2</option>
            <option value = '3'>3</option>
            <option value = '4'>4</option>
            <option value = '5'>5</option>
            </select> *<br>
            <span class='error'>$servError</span>
            <br>";

            echo "<label for='deco'>Decoración: </label>
            <select name='decoracion' id='deco'>
            <option value = '-'>-</option>
            <option value = '1'>1</option>
            <option value = '2'>2</option>
            <option value = '3'>3</option>
            <option value = '4'>4</option>
            <option value = '5'>5</option>
            </select> *<br>
            <span class='error'>$decoError</span>
            <br>";

            echo "<label for='camas'>Calidad de las camas: </label>
            <select name='camas' id='camas'>
            <option value = '-'>-</option>
            <option value = '1'>1</option>
            <option value = '2'>2</option>
            <option value = '3'>3</option>
            <option value = '4'>4</option>
            <option value = '5'>5</option>
            </select> *<br>
            <span class='error'>$camaError</span>
            <br>";

            echo "<label for='comment'>Comentario (Máx. 256 Caracteres): </label><br>
                  <textarea id='comment' name='comment' rows='5' cols='50' maxlength='256'></textarea> *<br>
                  <span class='error'>$commError</span><br>";

            echo "<input type='submit' value='Enviar'>";
            echo "</form>";

        } else {
            echo "<form method='post' action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "?source=$source&id=$itemid'>";
            echo "<p><span class='error'>* Campo obligatorio</span></p><br>";
            echo "<label for='cali_hoteles'>Calidad de los Hoteles: </label>
            <select name='cali_hoteles' id='cali_hoteles'>
            <option value = '-'>-</option>
            <option value = '1'>1</option>
            <option value = '2'>2</option>
            <option value = '3'>3</option>
            <option value = '4'>4</option>
            <option value = '5'>5</option>
            </select> *<br>
            <span class='error'>$c_hotelError</span>
            <br>";

            echo "<label for='cali_transport'>Calidad de Transporte: </label>
            <select name='cali_transport' id='cali_transport'>
            <option value = '-'>-</option>
            <option value = '1'>1</option>
            <option value = '2'>2</option>
            <option value = '3'>3</option>
            <option value = '4'>4</option>
            <option value = '5'>5</option>
            </select> *<br>
            <span class='error'>$c_tranError</span>
            <br>";

            echo "<label for='cali_servicio'>Calidad de servicio: </label>
            <select name='cali_servicio' id='cali_servicio'>
            <option value = '-'>-</option>
            <option value = '1'>1</option>
            <option value = '2'>2</option>
            <option value = '3'>3</option>
            <option value = '4'>4</option>
            <option value = '5'>5</option>
            </select> *<br>
            <span class='error'>$c_servError</span>
            <br>";

            echo "<label for='caliprecio'>Relación calidad/precio: </label>
            <select name='caliprecio' id='caliprecio'>
            <option value = '-'>-</option>
            <option value = '1'>1</option>
            <option value = '2'>2</option>
            <option value = '3'>3</option>
            <option value = '4'>4</option>
            <option value = '5'>5</option>
            </select> *<br>
            <span class='error'>$caliprecioError</span>
            <br>";

            echo "<label for='comment'>Comentario (Máx. 256 Caracteres): </label><br>
                  <textarea id='comment' name='comment' rows='5' cols='50' maxlength='256'></textarea> *<br>
                  <span class='error'>$commError</span><br>";

            echo "<input type='submit' value='Enviar'>";
            echo "</form>";
        }
    ?>
    <!-- <h3>Deja una reseña</h3> -->
<br><br>
<?php

if($source==='hotel'){
    $query = "
    SELECT id_user,limpieza,servicio,deco,camas,reseña,fecha FROM hotel_review WHERE id_hotel = $itemid
    ORDER BY fecha DESC;
    ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0){ 
        while ($row = mysqli_fetch_assoc($result)) {
            $reviewuserid = $row['id_user'];
            $limpieza = $row['limpieza'];
            $servicio = $row['servicio'];
            $deco = $row['deco'];
            $camas = $row['camas'];
            $reseña = $row['reseña'];
            $fecha = $row['fecha'];

            $query = "
            SELECT username FROM users WHERE id = $reviewuserid
            ";

            $result2 = mysqli_query($conn, $query);
            if (mysqli_num_rows($result2) > 0){ 
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $username = $row2['username'];
                    echo "$username<br>";
                    echo "Fecha: $fecha <br>";
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
        echo "No hay reviews";
    }    
}


if($source==='paquete'){
    $query = "
    SELECT id_user,cal_hoteles,cal_transport,cal_servicio,rel_calprecio,reseña,fecha FROM package_review WHERE id_pack = $itemid
    ORDER BY fecha DESC;
    ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0){ 
        while ($row = mysqli_fetch_assoc($result)) {
            $reviewuserid = $row['id_user'];
            $cal_hoteles = $row['cal_hoteles'];
            $cal_transport = $row['cal_transport'];
            $cal_servicio = $row['cal_servicio'];
            $rel_calprecio = $row['rel_calprecio'];
            $reseña = $row['reseña'];
            $fecha = $row['fecha'];

            $query = "
            SELECT username FROM users WHERE id = $reviewuserid
            ";

            $result2 = mysqli_query($conn, $query);
            if (mysqli_num_rows($result2) > 0){ 
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $username = $row2['username'];
                    echo "$username<br>";
                    echo "Fecha: $fecha <br>";
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
        echo "No hay reviews";
    }    
}
?>

</div>
</div>

<?php include 'footer_template.php';