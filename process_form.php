<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['guardar'])) {
        $id = $_POST['id'];
        $nombre_producto = $_POST['nombre_producto'];
        $marca = $_POST['marca'];
        $cantidad = $_POST['cantidad'];
        $fecha_vencimiento = $_POST['fecha_vencimiento'];
        $ubicacion = $_POST['ubicacion'];

        // Actualiza los datos del producto en la base de datos
        if (empty($id)) {
            $sql = "INSERT INTO products (nombre_producto, marca, cantidad, fecha_vencimiento, ubicacion) VALUES ('$nombre_producto', '$marca', $cantidad, '$fecha_vencimiento', '$ubicacion')";
        } else {
            $sql = "UPDATE products SET nombre_producto='$nombre_producto', marca='$marca', cantidad=$cantidad, fecha_vencimiento='$fecha_vencimiento', ubicacion='$ubicacion' WHERE id=$id";
        }

        if ($conn->query($sql) === TRUE) {
            //echo "Producto guardado exitosamente.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Elimina el producto que elijas de la base de datos
    if (isset($_POST['eliminar'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM products WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            //echo "Producto eliminado exitosamente.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>
