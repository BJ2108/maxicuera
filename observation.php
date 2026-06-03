<?php

date_default_timezone_set('America/Argentina/Buenos_Aires');
include 'db.php';
session_start();

// Obtener el ID del usuario actual
$user_id = $_SESSION['user_id'];

// Consultar el rol del usuario actual
$role_result = $conn->query("SELECT role FROM users WHERE id = $user_id");
$role = $role_result->fetch_assoc()['role'];

// Consultar productos para los selects
$productos_result = $conn->query("SELECT id, nombre_producto FROM products");
$productos = [];
if ($productos_result) {
    while ($producto = $productos_result->fetch_assoc()) {
        $productos[] = $producto;
    }
}

// Consultar todas las observaciones ordenadas por fecha (más reciente primero)
$sql = "SELECT observations.id, products.nombre_producto, users.username, observations.observacion, observations.fecha_hora 
        FROM observations 
        JOIN products ON observations.product_id = products.id 
        JOIN users ON observations.user_id = users.id
        ORDER BY observations.fecha_hora DESC";
$observaciones = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="imagenes/favicon.png" type="image/png">
    <title>CONTROL DE OBSERVACIONES</title>
</head>
<body>
    <nav>
        <div id="nav-maxi"><a href="main.php"><img id="img-maxi" src="imagenes/maxicuera-logo.png"></a></div>
        <div id="nav-logout"><a href="logout.php" id="boton-logout"><strong>CERRAR SESIÓN</strong></a></div>
    </nav>

    <!-- Barra de navegación de administradores con boton de productos, usuarios y observaciones -->
    <div class="div-barratareas">
        <a class="block text-desktop" href="product.php">PRODUCTOS</a>
        <?php if ($role == 'admin'): ?>
            <a class="block text-desktop" href="user_management.php">USUARIOS</a>
        <?php endif; ?>
        <a class="block-select text-desktop" href="observation.php">OBSERVACIONES</a>
    </div>

    <h2>Control de Observaciones</h2>
    <hr>
    <div id="div-usuario">
        <div class="div-form">
            <form action="process_observations.php" method="POST">
                <input type="hidden" name="action" value="add">
                <label for="product_id">Producto:</label>
                <select name="product_id" id="product_id" required>
                    <?php foreach ($productos as $producto): ?>
                        <option value="<?php echo $producto['id']; ?>"><?php echo $producto['id']; ?></option>
                    <?php endforeach; ?>
                </select><br><br>

                <label for="observacion">Observación:</label>
                <textarea name="observacion" id="observacion" required></textarea><br><br>

                <button class="guardado" type="submit">Agregar Observación</button>
            </form>
        </div>
    </div>
    <hr>
    <div id="div-tablas">
        <table id="tabla-productos" border="1">
            <thead>
                <tr>
                    <th class="cabecera col-id">ID</th>
                    <th class="cabecera">Producto</th>
                    <th class="cabecera col-user">Usuario</th>
                    <th class="cabecera">Observación</th>
                    <th class="cabecera col-fecha">Fecha</th>
                    <?php if ($role == 'admin'): ?>
                        <th class="cabecera col-accion">Eliminar</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($obs = $observaciones->fetch_assoc()): ?>
                <tr>
                    <td class="col-id"><?php echo $obs['id']; ?></td>
                    <td><?php echo $obs['nombre_producto']; ?></td>
                    <td class="col-user"><?php echo $obs['username']; ?></td>
                    <td><?php echo $obs['observacion']; ?></td>
                    <td class="col-fecha"><?php echo $obs['fecha_hora']; ?></td>
                    <?php if ($role == 'admin'): ?>
                        <td>
                            <form action="process_observations.php" method="POST" style="display:inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="observacion_id" value="<?php echo $obs['id']; ?>">
                                <div id="div-botons">
                                    <button class="eliminar" type="submit">Eliminar</button>
                                </div>
                            </form>
                        </td>
                    <?php endif; ?>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
