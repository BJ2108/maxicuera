<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];

$products_sql = "SELECT * FROM products";
$products = $conn->query($products_sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="imagenes/favicon.png" type="image/png">
    <title>CONTROL DE PRODUCTOS</title>
</head>
<body>
    <nav>
        <div id="nav-maxi"><a href="main.php"><img id="img-maxi" src="imagenes/maxicuera-logo.png"></a></div>
        <div id="nav-logout"><a href="logout.php" id="boton-logout"><strong>CERRAR SESIÓN</strong></a></div>
    </nav>

    <!-- Barra de navegación de administradores: se muestra un boton de productos, usuarios y observaciones -->
        <div class="div-barratareas">
            <a class="block-select text-desktop" href="product.php">PRODUCTOS</a>
            <?php if ($role == 'admin'): ?>
                <a class="block text-desktop" href="user_management.php">USUARIOS</a>
            <?php endif; ?>
            <a class="block text-desktop" href="observation.php">OBSERVACIONES</a>
        </div>

    <h2>Control de Productos</h2>
    <hr>
    
    <!-- Formulario para el administrador que permite editar/crear los productos-->
    <?php if ($role == 'admin'): ?>
        <?php include 'process_form.php'; ?>
        <div id="div-productos">
            <div class="div-form">
                <form method="post" action="">
                    <input type="hidden" name="id" id="id">
                    <div class="div-label-input">
                        <label for="nombre_producto">Nombre del Producto</label>
                        <input class="input-form" type="text" name="nombre_producto" id="nombre_producto" required>
                    </div>
                    <div class="div-label-input">
                        <label for="marca">Marca</label>
                        <input class="input-form" type="text" name="marca" id="marca" required>
                    </div>
                    <div class="div-label-input">
                        <label for="cantidad">Cantidad</label>
                        <input class="input-form" type="number" name="cantidad" id="cantidad" required>
                    </div>
                    <div class="div-label-input">
                        <label for="fecha_vencimiento">Fecha de Vencimiento</label>
                        <input class="input-form" type="date" name="fecha_vencimiento" id="fecha_vencimiento" required>
                    </div>
                    <div class="div-label-input">
                        <label for="ubicacion">Ubicación</label>
                        <input class="input-form" type="text" name="ubicacion" id="ubicacion" required>
                    </div>
                    <button class="guardado" type="submit" name="guardar">Guardar</button>
                </form>
            </div>
        </div>
        <hr>
    <?php endif; ?>

    <div id="div-tablas">
        <?php include 'display_table.php'; ?> <!-- Incluye el archivo que muestra la tabla de productos -->
    </div>

    <?php include 'fill_form.php'; ?> <!-- Incluye el archivo que rellena el formulario de productos para editarlos -->
</body>
</html>
