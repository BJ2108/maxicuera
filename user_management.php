<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="imagenes/favicon.png" type="image/png">
    <title>CONTROL DE USUARIOS</title>
</head>
<body>
    <nav>
        <div id="nav-maxi"><a href="main.php"><img id="img-maxi" src="imagenes/maxicuera-logo.png"></a></div>
        <div id="nav-logout"><a href="logout.php" id="boton-logout"><strong>CERRAR SESIÓN</strong></a></div>
    </nav>

    <!-- Barra de navegación de administradores con boton de productos, usuarios y observaciones -->
    <?php if ($role == 'admin'): ?>
        <div class="div-barratareas">
            <a class="block text-desktop" href="product.php">PRODUCTOS</a>
            <a class="block-select text-desktop" href="user_management.php">USUARIOS</a>
            <a class="block text-desktop" href="observation.php">OBSERVACIONES</a>
        </div>
    <?php endif; ?>

        <h2>Control de Usuarios</h2>
        <hr>
        

    <!-- Formulario de administradores que permite editar/crear los usuarios -->
    <?php if ($role == 'admin'): ?>
        <?php include 'process_users.php'; ?>
        <div id="div-usuario">
            <div class="div-form">
                <form method="post" action="">
                    <input type="hidden" name="id" id="id">
                    <div class="div-label-input">
                        <label for="username">Nombre de Usuario</label>
                        <input type="text" name="username" id="username" required>
                    </div>
                    <div class="div-label-input">
                        <label for="nombre_apellido">Nombre y Apellido</label>
                        <input type="text" name="nombre_apellido" id="nombre_apellido" required>
                    </div>
                    <div class="div-label-input">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    <div class="div-label-input">
                        <div class="contenedor-mostrar-contraseña">
                            <input type="checkbox" id="mostrar-contraseña">
                            <label class="ver-contra" for="mostrar-contraseña">Mostrar Contraseña</label>
                        </div>
                    </div>
                    <div class="div-label-input">
                        <label for="role">Rol</label>
                        <select id="select-rol" name="role" id="role" required>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <button class="guardado" type="submit" name="guardar">Guardar</button>
                </form>
            </div>
        </div>
        <hr>
    <?php endif; ?>

    <div id="div-tablas">
        <?php include 'display_users.php'; ?> <!-- Incluye el archivo que muestra la tabla de usuarios -->
    </div>

    <?php include 'fill_user_form.php'; ?> <!-- Incluye el archivo que rellena el formulario de usuarios para editarlos -->


    <!-- Este código de javascript sirve para el funcionamiento del boton para ocultar y mostrar contraseña -->
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
