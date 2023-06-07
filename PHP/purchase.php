<?php require 'config/database.php';

    $userid = $_GET['id'];
    $prev_url = $_SERVER['HTTP_REFERER'];
    $cartquery = "SELECT * FROM cart WHERE id_user=$userid";
    $result = mysqli_query($conn, $cartquery);

    if($result) {
        while ($row = mysqli_fetch_assoc($result)){
            $ishotel = $row['ishotel'];
            $quant = $row['quant'];
            if($ishotel){
                $hotelid = $row['id_hotel'];
                mysqli_query($conn, "UPDATE hotel SET hab_disp = (hab_disp - $quant) WHERE id_hotel=$hotelid");

            } else {
                $packid = $row['id_pack'];
                $packquery = "SELECT id_hospedajes, max_personas FROM paquete WHERE id_paquete=$packid";
                $packresult = mysqli_query($conn, $packquery);
                $packrow = mysqli_fetch_assoc($packresult);
                $id_hosp = $packrow['id_hospedajes'];
                $max_per = $packrow['max_personas'];

                $hospquery = "SELECT * FROM grupo_hospedajes WHERE id=$id_hosp";
                $hospresult = mysqli_query($conn, $hospquery);
                $hosprow = mysqli_fetch_assoc($hospresult);
                $hotel1 = $hosprow['id_hotel1'];
                $hotel2 = $hosprow['id_hotel2'];
                $hotel3 = $hosprow['id_hotel3'];

                mysqli_query($conn, "UPDATE hotel SET hab_disp = (hab_disp - $max_per) WHERE id_hotel=$hotel1");

                if(!is_null($hotel2)) {
                    mysqli_query($conn, "UPDATE hotel SET hab_disp = (hab_disp - $max_per) WHERE id_hotel=$hotel2");
                }
                if(!is_null($hotel3)) {
                    mysqli_query($conn, "UPDATE hotel SET hab_disp = (hab_disp - $max_per) WHERE id_hotel=$hotel3");
                }

                mysqli_query($conn, "UPDATE paquete SET paq_disp = (paq_disp - $quant) WHERE id_paquete=$packid");

            }
        }

        mysqli_query($conn, "INSERT INTO historial (id_user, id_hotel, id_pack, ishotel, quant) SELECT id_user, id_hotel, id_pack, ishotel, quant FROM cart");
        mysqli_query($conn, "DELETE FROM cart WHERE id_user=$userid");
        echo "<script>alert('Has reservado los contenidos de tu carrito');
                      window.location = '$prev_url';
              </script>";
        exit();
    }


?>