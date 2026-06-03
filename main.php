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
        <div id="nav-maxi"><a href="main.php"><img id="img-maxi" src="imagenes/maxicuera-logo.png"></a></div>
        <div id="nav-logout"><a href="logout.php" id="boton-logout"><strong>CERRAR SESIÓN</strong></a></div>
    </nav>
    <!-- El codigo php sirve para que te aparezca tu nombre de usuario (ejemplo: Si sos Pepito va a aparecer "Bienvenido Pepito") -->
    <h1 class="bienvenida">Bienvenido <?php echo $username; ?></h1>
    <hr>

    <!-- Este código php sirve para que solo los Administradores puedan ver este apartado de la página, si sos usuario normal no lo podrás ver -->
        <!-- Creación de contenedores y divs para los botones de control de productos, usuarios y observaciones -->
        <div class="container">
            <div class="bloque">
                <div class="txt-bloque"><a class="enlace-bloque" href="product.php">CONTROL DE PRODUCTOS</a></div>
                <div class="icon-bloque"><img src="imagenes/productos.png" alt="productos"></div>
            </div>
            <?php if ($role == 'admin'): ?>
                <div class="bloque">
                    <div class="txt-bloque"><a class="enlace-bloque" href="user_management.php">CONTROL DE USUARIOS</a></div>
                    <div class="icon-bloque"><img src="imagenes/users.png" alt="usuarios"></div>
                </div>
            <?php endif; ?>
            <div class="bloque">
                <div class="txt-bloque"><a class="enlace-bloque" href="observation.php">CONTROL DE OBSERVACIONES</a></div>
                <div class="icon-bloque"><img src="imagenes/observacion.png" alt="observacion"></div>
            </div>
        </div>

</body>
</html>