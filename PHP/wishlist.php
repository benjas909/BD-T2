<?php include 'header_template.php'; ?>
<br><br>

<div class="wish-container">
    <?php
        $query = "SELECT * FROM wishlist";
        $result = mysqli_query($conn, $query);

        if($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='card'>";
                
                if($row['ishotel']){
                    $idhotel = $row['id_hotel'];
                    $hquery = "SELECT nombre, img FROM hotel WHERE id_hotel=$idhotel";
                    $hresult = mysqli_query($conn, $hquery);

                    if($hresult) {
                        while($hrow = mysqli_fetch_assoc($hresult)){
                            $hname = $hrow['nombre'];
                            $himg = $hrow['img'];

                            echo "<div class='image'>
                                <img src='$himg' alt='$hname'>
                              </div>";
                            echo "<div class='info'>";
                            echo "<h2>$hname</h2>";
                            // echo "<h3>Cantidad: $quant</h3>";
                            echo "</div>";

                        }
                    }
                } elseif (!$row['ishotel']) {
                    $packid = $row['id_pack'];
                    $pquery = "SELECT nombre, img FROM paquete WHERE id_paquete=$packid";
                    $presult = mysqli_query($conn, $pquery);

                    if($presult) {
                        while($prow = mysqli_fetch_assoc($presult)){
                            $pname = $prow['nombre'];
                            $pimg = $prow['img'];

                            echo "<div class='image'>
                                    <img src='$pimg' alt='$pname'>
                                </div>";
                            echo "<div class='info'>";
                            echo "<h2>$pname</h2>";
                            echo "</div>";
                        }
                    }
                }
                echo "</div>";
            }
        } else {
            echo "<h1>No has agregado elementos a tu wishlist.</h1>";
        }
    ?>

</div>


<?php include 'footer_template.php'; ?>