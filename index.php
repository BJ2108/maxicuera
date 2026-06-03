<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <!-- el favicon.png es para crear la imagen del ícono que va arriba en la barra de navegación -->
    <link rel="icon" href="imagenes/favicon.png" type="image/png"> 
    <title>Maxicuera</title>
</head>
<body>
    <!-- Aqui se crea el nav, que viene con dos divs, uno con el icono de la empresa y otro para crear el boton login -->
    <nav>
        <div id="nav-maxi"><a href="index.php"><img id="img-maxi" src="imagenes/maxicuera-logo.png"></a></div>
        <div id="nav-login"><a href="login.php" id="boton-login"><strong>INICIAR SESIÓN</strong></a></div>
    </nav>
    
    <!-- Aqui se crea en un div las dos imagenes sobre horarios y ubicacion en el inicio de la página -->
    <div id="contenedor-imagen">
        <img id="img-hora" src="imagenes/horarios.jpg">
        <img id="img-ubi" src="imagenes/ubicacion.jpg">
    </div>
</body>
</html>