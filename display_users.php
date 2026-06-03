<?php
include 'db.php';

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Si se encuentran resultados, crea una tabla HTML para mostrar los usuarios
    echo "<table id='tabla-usuarios' border='1'>
    <tr>
        <th class='cabecera col-id'>ID</th>
        <th class='cabecera'>Nombre de Usuario</th>
        <th class='cabecera'>Nombre y Apellido</th>
        <th class='cabecera col-rol'>Rol</th>
        <th class='cabecera col-accion'>Acciones</th>
    </tr>";
    while ($row = $result->fetch_assoc()) {
        // Repite sobre cada fila de resultados y crea una fila de tabla para cada usuario
        echo "<tr>
            <td class='col-id'>" . $row["id"] . "</td>
            <td class='col-user'>" . $row["username"] . "</td>
            <td>" . $row["nombre_apellido"] . "</td>
            <td class='col-rol'>" . $row["role"] . "</td>
            <td>
                <form method='post' action='' style='display:inline;'>
                    <input type='hidden' name='id' value='" . $row["id"] . "'>
                    <input type='hidden' name='username' value='" . $row["username"] . "'>
                    <input type='hidden' name='nombre_apellido' value='" . $row["nombre_apellido"] . "'>
                    <input type='hidden' name='role' value='" . $row["role"] . "'>
                    <div id='div-botons'>
                        <button type='submit' name='editar' class='boton editar'>Editar</button>
                        <button type='submit' name='eliminar' class='boton borrar'>Eliminar</button>
                    </div>
                </form>
            </td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 resultados";
}

$conn->close();
?>
