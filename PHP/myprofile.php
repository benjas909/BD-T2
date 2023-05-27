<?php include 'header_template.php';

echo $_SESSION["username"];

$id = $_SESSION["id"];

if ($stmt = mysqli_prepare($conn, "SELECT email, birthday FROM users WHERE id = ?")) {
    mysqli_stmt_bind_param($stmt, "s", $id);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);

        mysqli_stmt_bind_result($stmt, $email, $birthday);

        if (mysqli_stmt_fetch($stmt)) {
            echo "email: " . $email . "<br>";
            echo "Fecha de Nacimiento: " . $birthday . "<br>";
        }
    }
} else {
    echo "Error de query, revisar.";
}

?>

<a href="wishlist.php">Mi Wishlist</a>

<?php
include 'footer_template.php';
?>