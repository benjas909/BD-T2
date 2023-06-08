<?php include 'header_template.php'; ?>
<br><br>

<div class="wish-container">
    <?php
        $userid = $_SESSION['id'];
        $query = "SELECT * FROM wishlist WHERE id_user=$userid";
        $result = mysqli_query($conn, $query);

        if($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='card'>";
                $ishotel = $row['ishotel'];
                
                if($ishotel){
                    $idhotel = $row['id_hotel'];
                    $hquery = "SELECT nombre, img,calif_promedio FROM hotel WHERE id_hotel=$idhotel";
                    $hresult = mysqli_query($conn, $hquery);

                    if($hresult) {
                        while($hrow = mysqli_fetch_assoc($hresult)){
                            $hname = $hrow['nombre'];
                            $himg = $hrow['img'];
                            $hcalif_promedio=$hrow['calif_promedio'];

                            echo "<div class='image'>
                                    <img src='$himg' alt='$hname'>
                                  </div>";
                            echo "<div class='info'>";
                            echo "<a href='info.php?source=hotel&id=$idhotel'>";
                            echo "<h2>$hname</h2>";
                            echo "</a>";
                            echo "Puntuación: $hcalif_promedio/5";
                            echo "</div>";
                            echo "<div class='remove'>
                                    <a href='add_wishlist.php?itemid=$idhotel&ishotel=$ishotel'>Eliminar de Wishlist</a>
                                  </div>";

                        }
                    }
                } elseif (!$ishotel) {
                    
                    $packid = $row['id_pack'];
                    $pquery = "SELECT nombre, img,calif_promedio FROM paquete WHERE id_paquete=$packid";
                    $presult = mysqli_query($conn, $pquery);

                    if($presult) {
                        while($prow = mysqli_fetch_assoc($presult)){
                            $pname = $prow['nombre'];
                            $pimg = $prow['img'];
                            $pcalif_promedio=$prow['calif_promedio'];
                            echo "<div class='image'>
                                    <img src='$pimg' alt='$pname'>
                                </div>";
                            echo "<div class='info'>";
                            echo "<a href='info.php?source=paquete&id=$packid'>";
                            echo "<h2>$pname</h2>";
                            echo "</a>";
                            echo "Puntuación: $hcalif_promedio/5";
                            echo "</div>";
                            echo "<div class='remove'>
                                    <a href='add_wishlist.php?itemid=$packid&ishotel=$ishotel'>Eliminar de Wishlist</a>
                                  </div>";
                        }
                    }
                }
                echo "</div>";
            }
            // if (!$row) {
            //     echo "<h1>No has agregado elementos a tu wishlist.</h1>";

            // }
        } 
    ?>

</div>


<?php include 'footer_template.php'; ?>