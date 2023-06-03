<?php require 'config/database.php'; ?>

<?php

function clean_inputs($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Se inicia la sesión
session_start();

// Si el usuario ya está logeado, se le redirecciona a la página de inicio
if (isset($_SESSION["isloggedin"]) && $_SESSION["isloggedin"] == true) {
    header("location: index.php");
    exit;
}

// Se inicializan las variables
$usrNameError = $passError = $loginErr = "";
$username = $password = "";

// Procesamiento de datos enviados desde formulario de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Revisar si el usuario no ingresó el nombre
    if (empty(clean_inputs($_POST["username"]))) {
        $usrNameError = "Por favor ingrese su nombre de usuario.";
    } else {
        // Si ingresó, se asigna a la variable correspondiente
        $username = clean_inputs($_POST["username"]);
    }

    // Revisar si el usuario ingresó su contraseña
    if (empty(clean_inputs($_POST["password"]))) {
        $passError = "Por favor ingrese su contraseña.";
    } else {
        // Si ingresó su contraseña, se asigna a la variable correspondiente
        $password = clean_inputs($_POST["password"]);
    }

    // Si no hay errores, se verifican los datos ingresados
    if (empty($usrNameError) && empty($passError)) {

        if ($stmt = mysqli_prepare($conn, "SELECT id, username, password FROM users WHERE username = ?")) {

            mysqli_stmt_bind_param($stmt, "s", $username);

            // Ejecución de la query preparada
            if (mysqli_stmt_execute($stmt)) {

                mysqli_stmt_store_result($stmt);

                // Se revisa si existe el usuario
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Se designan las variables a las que se les asignará el resultado de la query
                    mysqli_stmt_bind_result($stmt, $id, $username, $hash_password);

                    if (mysqli_stmt_fetch($stmt)) {
                        // Se verifica que la contraseña coincida con el hash guardado en la BD

                        if (password_verify($password, $hash_password)) {
                            // La contraseña coincide
                            session_start();

                            // Se almacenan los datos en las variables de sesión
                            $_SESSION["username"] = $username;
                            $_SESSION["isloggedin"] = true;
                            $_SESSION["id"] = $id;

                            // Se redirecciona a la página home
                            header("location: index.php");
                        } else {
                            $loginErr = "La contraseña o el nombre de usuario no son correctos.";
                        }
                    }
                } else {
                    // No existe el usuario
                    $loginErr = "El usuario no existe.";
                }
            } else {
                echo "Error de ejecución, revisar. (dev)";
            }
            mysqli_stmt_close($stmt);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>PrestigeTravels - Login</title>
    <style>
        body {
            background-color: #080710;
        }

        .error {
            color: tomato;

        }

        form {
            height: 520px;
            width: 400px;
            background-color: rgba(255, 255, 255, 0.13);
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            padding: 50px 35px;
        }

        form * {
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }

        form h3 {
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 30px;
            font-size: 16px;
            font-weight: 500;
        }

        input {
            display: block;
            height: 50px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.07);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
        }

        ::placeholder {
            color: #e5e5e5;
        }

        input[type=submit] {
            background-color: #04AA6D;
            color: white;
            cursor: pointer;
        }
    </style>
</head>

<body>



    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h3>Iniciar sesión</h3>
        <label for="username">Nombre de Usuario</label>
        <input type="text" name="username" id="username" placeholder="Nombre de Usuario"><br>
        <span class="error">
            <?php echo $usrNameError ?>
        </span>
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" placeholder="Contraseña"><br>
        <span class="error">
            <?php echo $passError ?>
        </span>
        <input type="submit" value="Iniciar sesión">
        <span class="error">
            <?php echo $loginErr ?>
        </span>
        <p>¿Aún no tienes una cuenta? <a href="signup.php">Regístrate!</a></p>

    </form>

</body>