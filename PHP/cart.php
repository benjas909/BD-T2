<?php include 'header_template.php'; ?>

<br><br>
<div class="cart-container">
    <?php
    $query = "SELECT * FROM cart";

    $result = mysqli_query($conn, $query);
    $totalprice = 0;


    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='card'>";
            $ishotel = $row['ishotel'];
            // $id = $row['id'];
            $quant = $row['quant'];
            if ($ishotel) {
                $hotelid = $row['id_hotel'];
                // echo $hotelid;
                $hquery = "SELECT nombre, precionoche, img FROM hotel WHERE id_hotel=$hotelid";
                $hresult = mysqli_query($conn, $hquery);

                if ($hresult) {
                    while ($hrow = mysqli_fetch_assoc($hresult)) {
                        $hname = $hrow['nombre'];
                        $himg = $hrow['img'];
                        $hprice = $hrow['precionoche'];

                        echo "<div class='image'>
                                <img src='$himg' alt='$hname'>
                              </div>";
                        echo "<div class='info'>";
                        echo "<h2>$hname</h2>";
                        echo "<h3>Cantidad: $quant</h3>";
                        echo "</div>";
                        echo "<div class='price'>";
                        echo "<h2>$$hprice <h5>/noche</h5></h2>";
                        echo "</div>";
                        echo "<div class='remove'>
                                    <a href='remove_cart.php?itemid=$hotelid&ishotel=$ishotel'>Eliminar de Wishlist</a>
                                  </div>";
                        $totalprice = $totalprice + ($quant * $hprice);
                    }
                }
            } elseif (!$ishotel) {
                $packid = $row['id_pack'];
                $pquery = "SELECT nombre, precio_persona, img FROM paquete WHERE id_paquete=$packid";
                $presult = mysqli_query($conn, $pquery);

                if ($presult) {
                    while ($prow = mysqli_fetch_assoc($presult)) {
                        $pname = $prow['nombre'];
                        $pimg = $prow['img'];
                        $price = $prow['precio_persona'];

                        echo "<div class='image'>
                                <img src='$pimg' alt='$pname'>
                              </div>";
                        echo "<div class='info'>";
                        echo "<h2>$pname</h2>";
                        echo "<h3>Cantidad: $quant</h3>";
                        echo "</div>";
                        echo "<div class='price'>";
                        echo "<h2>$$price<h5>/persona</h5></h2>";
                        echo "</div>";
                        echo "<div class='remove'>
                                    <a href='remove_cart.php?itemid=$packid&ishotel=$ishotel'>Eliminar de Wishlist</a>
                                  </div>";
                        $totalprice = $totalprice + ($quant * $price);
                    }
                }
            }
            echo "</div>";
        }
        echo "<h1 class='totalprice'>Precio total: $$totalprice</h1>";
    } else {
        echo "<h1>Tu carrito está vacío</h1>";
    }

    ?>
</div>
<?php include 'footer_template.php'; ?>