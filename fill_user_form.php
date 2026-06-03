<?php
// ESTE CODIGO SIRVE PARA PODER EDITAR LOS USUARIOS QUE QUIERAS DE LA TABLA

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar'])) {
    // Verifica si se ha enviado una solicitud POST para editar los usuarios (id, nombre de usuario y su rol)
    $id = $_POST['id'];
    $username = $_POST['username'];
    $nombre_apellido = $_POST['nombre_apellido'];
    $role = $_POST['role'];

    // Muestra un formulario con los datos del producto, permitiendo editar los usuarios
    echo "<script>
    document.getElementById('id').value = '$id';
    document.getElementById('username').value = '$username';
    document.getElementById('nombre_apellido').value = '$nombre_apellido';
    document.getElementById('role').value = '$role';
    </script>";
}
?>
