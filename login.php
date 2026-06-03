<?php
include 'db.php';
session_start();

// Comprueba si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Obtiene el nombre de usuario y la contraseña del formulario
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    // Verifica si el usuario que ingresaste existe en la base de datos
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            header('Location: main.php');
        
        } else {
            $error = "Contraseña Incorrecta."; 
        }

    } else {
        $error = "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="imagenes/favicon.png" type="image/png">
    <title>Maxicuera</title>
</head>
<body>
    <nav>
        <div id="nav-maxi"><a href="index.php"><img id="img-maxi" src="imagenes/maxicuera-logo.png"></a></div>
        <div id="nav-login"><a href="login.php" id="boton-login"><strong>INICIAR SESIÓN</strong></a></div>
    </nav>
    <!-- Creación del contenedor del inicio de sesión con el input de ingresar usuario, contraseña y el boton para iniciar sesion -->
    <div class="main-container">
        <div class="login-container">
            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <form method="POST" action="" id="login-form">
                <label id="label-name" for="username">USUARIO</label>
                <input type="text" id="username" name="username" required>
                <label id="label-pass" for="password">CONTRASEÑA</label>
                <input type="password" id="password" name="password" required>
                <div class="contenedor-mostrar-contraseña">
                    <input type="checkbox" id="mostrar-contraseña">
                    <label class="ver-contra" for="mostrar-contraseña">Mostrar Contraseña</label>
                </div>
                <button id="submit" type="submit">INICIAR SESIÓN</button>
            </form>
        </div>
        
    </div>

    <!-- Código de javascript para el boton de ocultar y mostrar contraseña -->
    <script>
        const checkbox = document.getElementById('mostrar-contraseña');
        const passwordInput = document.getElementById('password');

        checkbox.addEventListener('change', function() {
            if (checkbox.checked) {
                passwordInput.type = 'text';  // Muestra la contraseña
            } else {
                passwordInput.type = 'password';  // Oculta la contraseña
            }
        });
    </script>
</body>
</html>