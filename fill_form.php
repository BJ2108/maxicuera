<?php
// ESTE CODIGO SIRVE PARA PODER EDITAR LOS PRODUCTOS QUE QUIERAS DE LA TABLA

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar'])) {
    // Verifica si se ha enviado una solicitud POST para editar los productos
    $id = $_POST['id'];
    $nombre_producto = $_POST['nombre_producto'];
    $marca = $_POST['marca'];
    $cantidad = $_POST['cantidad'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $ubicacion = $_POST['ubicacion'];

    // Muestra un formulario con los datos del producto, permitiendo editar los productos
    echo "<script>
    document.getElementById('id').value = '$id';
    document.getElementById('nombre_producto').value = '$nombre_producto';
    document.getElementById('marca').value = '$marca';
    document.getElementById('cantidad').value = '$cantidad';
    document.getElementById('fecha_vencimiento').value = '$fecha_vencimiento';
    document.getElementById('ubicacion').value = '$ubicacion';
    </script>";
}
?>
