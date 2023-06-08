<?php require 'config/database.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Prestige Travels - Registrarse </title>
</head>

<body>

    <?php
    function clean_inputs($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $usrNameError = $emailError = $bdayError = $passError = $confirmError = "";
    $username = $email = $birth = $password = $confirm_password = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Si se llegó a esa página por método de POST, hacer lo siguiente
    
        if (empty($_POST["username"])) {
            $usrNameError = "El nombre de usuario es obligatorio.";
        } else {
            $username = clean_inputs($_POST["username"]);

            if ($stmt = mysqli_prepare($conn, "SELECT id FROM users where username = ?")) {
                mysqli_stmt_bind_param($stmt, "s", $username);

                if (mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $usrNameError = "El Nombre de usuario ya está en uso.";
                    }

                } else {
                    echo "Error de ejecución al validar username, revisar. (dev)";
                }

                mysqli_stmt_close($stmt);
            }

        }

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
    
    
    
        if (empty($_POST["password"])) {
            $passError = "Contraseña requerida.";
        } else {
            $password = clean_inputs($_POST["password"]);
        }
    
        if (empty($_POST["confirm_password"])) {
            $confirmError = "Este campo es obligatorio.";
        } else {
            $confirm_password = clean_inputs($_POST["confirm_password"]);
    
            if (empty($confirmError) && ($confirm_password != $password)) {
                $confirmError = "Las contraseñas no son iguales.";
            }
        }
    
        if (empty($usrNameError) && empty($emailError) && empty($passError) && empty($confirmError) && empty($bdayError)) {
    
            if ($stmt = mysqli_prepare($conn, "INSERT INTO users (username, password, email, birthday) VALUES (?, ?, ?, ?)")) {
                mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_password, $param_email, $param_birthday);
    
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT);
                $param_email = $email;
                $param_birthday = $birth;
    
                if (mysqli_stmt_execute($stmt)) {
    
                    header("location: login.php");
                } else {
                    echo "Error de registro, revisar. (dev)";
                }
    
                mysqli_stmt_close($stmt);
            }
        }
    }



    ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <p><span class="error">* Campo obligatorio</span></p>
        Nombre de usuario: <input type="text" name="username" value="<?php echo $username ?>">
        <span class="error">*
            <?php echo $usrNameError; ?>
        </span><br>

        E-mail: <input type="text" name="email" value="<?php echo $email ?>">
        <span class="error">*
            <?php echo $emailError; ?>
        </span><br>

        Fecha de Nacimiento: <input type="date" name="birth">
        <span class="error">*
            <?php echo $bdayError; ?>
        </span><br>

        Contraseña: <input type="password" name="password">
        <span class="error"> *
            <?php echo $passError; ?>
        </span><br>

        Confirmar contraseña: <input type="password" name="confirm_password">
        <span class="error"> *
            <?php echo $confirmError; ?>
        </span><br>


        <input type="submit">
    </form>

</body>