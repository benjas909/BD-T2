<?php include 'header_template.php';


$id = $_SESSION["id"];
// $email = $_SESS
$emailError = $bdayError = "";
$email_new = $birth_new = "";

if ($stmt = mysqli_prepare($conn, "SELECT email, birthday FROM users WHERE id = ?")) {
    mysqli_stmt_bind_param($stmt, "s", $id);
    
    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);
        
        mysqli_stmt_bind_result($stmt, $email, $birthday);
        mysqli_stmt_fetch($stmt);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST["email"])) {
        $emailError = "El correo es obligatorio.";

    } else if (!filter_var(clean_inputs($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $emailError = "Correo inválido.";

    } else {
        $email = clean_inputs($_POST["email"]);

        if ($stmt = mysqli_prepare($conn, "SELECT email FROM users where email = ?")) {
            mysqli_stmt_bind_param($stmt, "s", $email);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $emailError = "Ya se ha creado una cuenta con este correo.";
                }
            } else {
                echo "Error de ejecución al validar correo, revisar. (dev)";
            }

            mysqli_stmt_close($stmt);
        }

    }

    if (empty($_POST["birth"])) {
        $bdayError = "La fecha de nacimiento es obligatoria";
    } else {
        $birth = clean_inputs($_POST["birth"]);
    }

    if(empty($emailError) && empty($bdayError)) {
        if($stmt = mysqli_prepare($conn, "UPDATE users SET email = ?, birthday = ? WHERE id=$id")) {
            mysqli_stmt_bind_param($stmt, "ss", $email_new, $birth_new);

            $email_new = $email;
            $birth_new = $birth;

            if(mysqli_stmt_execute($stmt)) {
                header("location: myprofile.php");
            } else {
                echo "Error al actualizar datos de usuario.";
            }
            mysqli_stmt_close($stmt);
        }

    }

}

?>

<div class="edit-profile">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <p><span class="error">* Campo obligatorio</span></p>
    
        E-mail: <input type="text" name="email" value="<?php echo $email ?>">
        <span class="error">*
            <?php echo $emailError; ?>
        </span><br>
    
        Fecha de Nacimiento: <input type="date" name="birth">
        <span class="error">*
            <?php echo $bdayError; ?>
        </span><br>
        <input type="submit">
    </form>
</div>

<div>
<a href="delete_profile.php" onclick="return confirm('¿Estás seguro?');">Eliminar Cuenta</a>
</div>

<?php include 'footer_template.php'; ?>