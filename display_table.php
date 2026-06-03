<?php
include 'db.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
$role = $_SESSION['role'];

if ($result->num_rows > 0) {
    // Si hay resultados, crea una tabla HTML para mostrar los productos
    echo "<table id='tabla-productos'>
    <tr>
        <th class='cabecera col-id'>ID</th>
        <th class='cabecera'>Nombre del Producto</th>
        <th class='cabecera'>Marca</th>
        <th class='cabecera col-cantidad'>Cantidad</th>
        <th class='cabecera col-fecha'>Fecha de Vencimiento</th>
        <th class='cabecera'>Ubicación</th>";
        if ($role == 'admin') {
            echo "<th class='cabecera col-accion'>Acciones</th>";
        }
    echo "</tr>";
    while ($row = $result->fetch_assoc()) {
        // Repite sobre cada fila de resultados y crea una fila de tabla para cada producto
        echo "<tr>
            <td class='col-id'>" . $row["id"] . "</td>
            <td>" . $row["nombre_producto"] . "</td>
            <td>" . $row["marca"] . "</td>
            <td class='col-cantidad'>" . $row["cantidad"] . "</td>
            <td class='col-fecha'>" . $row["fecha_vencimiento"] . "</td>
            <td>" . $row["ubicacion"] . "</td>";
        if ($role == 'admin') {
            echo "
            <td>
                <form method='post' action='' style='display:inline;'>
                    <input type='hidden' name='id' value='" . $row["id"] . "'>
                    <input type='hidden' name='nombre_producto' value='" . $row["nombre_producto"] . "'>
                    <input type='hidden' name='marca' value='" . $row["marca"] . "'>
                    <input type='hidden' name='cantidad' value='" . $row["cantidad"] . "'>
                    <input type='hidden' name='fecha_vencimiento' value='" . $row["fecha_vencimiento"] . "'>
                    <input type='hidden' name='ubicacion' value='" . $row["ubicacion"] . "'>
                    <div id='div-botons'>
                        <button type='submit' name='editar' class='boton editar'>Editar</button>
                        <button type='submit' name='eliminar' class='boton borrar'>Eliminar</button>
                    </div>
                </form>
            </td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 resultados";
}

$conn->close();
?>
