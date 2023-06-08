<?php require 'header_template.php';

$revid = $_GET['revid'];
$src = $_GET['src'];
$prev_url = $_SERVER['HTTP_REFERER'];
$userid = $_SESSION['id'];


if($src == 'hotel') {
    $hquery = mysqli_query($conn, "SELECT id_user, id_hotel FROM hotel_review WHERE id=$revid");
    if($hquery) {
        $row = mysqli_fetch_assoc($hquery);
        $itemid = $row['id_hotel'];
        if($row['id_user'] != $_SESSION['id']){
            echo "<script> alert('El usuario actual no es el autor de la reseña');
            window.location = $prev_url; </script>";
            exit();
        }
    }
} else {
    $pquery = mysqli_query($conn, "SELECT id_user, id_pack FROM package_review WHERE id=$revid");
    if($pquery) {
        $row = mysqli_fetch_assoc($pquery);
        $itemid = $row['id_pack'];
        if($row['id_user' != $_SESSION['id']]) {
            echo "<script> alert('El usuario actual no es el autor de la reseña');
            window.location = $prev_url; </script>";
            exit();
        }
    }
}

$obligError = "Este campo es obligatorio.";
$limpError = $servError = $decoError = $camaError = $commError = '';
$limp = $serv = $deco = $camas = $comment = '';
$c_hotelError = $c_tranError = $c_servError = $caliprecioError = $commError = '';
$calihotel = $calitran = $caliserv = $caliprec = $comment = '';
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if($src == 'hotel') {
        // echo "lol";
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

        if(empty($limpError) && empty($servError) && empty($decoError) && empty($camaError) && empty($commError)) {
            // echo "hola";

            if ($stmt = mysqli_prepare($conn, "UPDATE hotel_review SET limpieza = ?, servicio = ?, deco = ?, camas = ?, reseña = ?, review_promedio = ? WHERE id_user = ? AND id = ?")) {
                mysqli_stmt_bind_param($stmt, "ssssssss", $param_limp, $param_serv, $param_deco, $param_camas, $param_comment, $param_promedio, $param_userid, $param_revid);
                $param_userid = $userid;
                $param_revid = $revid;
                $param_limp = $limp;
                $param_serv = $serv;
                $param_deco = $deco;
                $param_camas = $camas;
                $param_comment = $comment;
                $param_promedio = ($limp + $serv + $deco + $camas)/4;
                try {
                    mysqli_stmt_execute($stmt);
                    // echo "hola";
                    header("location: info.php?source=$src&id=$itemid");
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

            if($stmt = mysqli_prepare($conn, "UPDATE package_review SET cal_hoteles = ?, cal_transport = ?, cal_servicio = ?, rel_calprecio = ?, reseña = ?,review_promedio = ? WHERE id_user = ? AND id = ?")) {
                mysqli_stmt_bind_param($stmt, "ssssssss", $param_chotel, $para_ctran, $param_cserv, $param_calipr, $param_comment, $param_promedio, $param_userid, $param_revid);

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
                    // echo "hola";
                    header("location:info.php?source=$src&id=$itemid");

                } catch (mysqli_sql_exception $e) {
                    echo "<h3>Error al enviar reseña: " . $e->getMessage() . "</h3>";
                }
                mysqli_stmt_close($stmt);
                
            }
        
        }
    }

}

echo "<div class='create-review'>";
if($src == 'hotel') {
    echo "<form method='post' action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "?revid=$revid&src=$src'>";
    echo "<p><span class='error'>* Campo obligatorio</span></p><br>";
    echo "<label for='limpieza'>Limpieza: </label>
    <select name='limpieza' id='limpieza'>
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
    echo "<form method='post' action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "?revid=$revid&src=$src'>";
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

