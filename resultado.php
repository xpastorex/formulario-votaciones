<?php

$nombre = $_POST["nombre"];
$alias = $_POST["alias"];
$rut = $_POST["rut"];
$email = $_POST["email"];
$region = $_POST["region"];
$comuna = $_POST["comuna"];
$candidato = $_POST["candidato"];
$nosotros = $_POST['langs'];
$nosotrosArray = implode(", ", $nosotros);


$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "votaciones";

$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

if (!$enlace) {
    echo "Error en la conexion con el servidor";
}


$sql = "INSERT INTO `usuarios`(`rut`, `nombre`, `alias`, `email`, `nosotros`, `comuna_id`, `region_id`, `candidato_id`) 
VALUES ('$rut','$nombre','$alias','$email','$nosotrosArray','$comuna','$region', '$candidato')";

mysqli_query($enlace, $sql);

?>