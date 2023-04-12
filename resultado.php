<?php

//Se guardan los datos del form llamandolos con el nombre que tienen asignados
$nombre = $_POST["nombre"];
$alias = $_POST["alias"];
$rut = $_POST["rut"];
$email = $_POST["email"];
$region = $_POST["region"];
$comuna = $_POST["comuna"];
$candidato = $_POST["candidato"];
$nosotros = $_POST['langs'];
//Se orgenan los datos de nosotros y se guardan concatenados en una string
$nosotrosString = implode(", ", $nosotros);


$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "votaciones";

$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

if (!$enlace) {
    echo "Error en la conexion con el servidor";
}

$r = "SELECT rut from usuarios WHERE rut = '$rut'";
$rr = mysqli_query($enlace, $r);
$message = '';


if (mysqli_num_rows($rr) > 0) {
    $message = '<p style="color : red"> Usted ya votó </p>';
} else {
    $sql = "INSERT INTO `usuarios`(`rut`, `nombre`, `alias`, `email`, `nosotros`, `comuna_id`, `region_id`, `candidato_id`) 
    VALUES ('$rut','$nombre','$alias','$email','$nosotrosString','$comuna','$region', '$candidato')";
    mysqli_query($enlace, $sql);
    $message = '<p style="color : green"> Voto Registrado </p>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Resultado Votacion</title>
</head>

<body>
    <section>
        <div class=resultado>
            <h1>Resultado Votacion</h1>
            <?php if (isset($message))
                echo $message ?>
                <button><a href="index.php">volver al inicio</a></button>
            </div>
        </section>
    </body>

    </html>