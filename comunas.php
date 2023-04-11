<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "votaciones";

$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);

if (!$enlace) {
    echo "Error en la conexion con el servidor";
}

$consulta = "SELECT * FROM communes";
$ejecutarConsulta = mysqli_query($enlace, $consulta);

echo '<select name="select" id="select" required>';
while ($fila = mysqli_fetch_array($ejecutarConsulta)) {
    if($fila['region_id'] == $_GET['c']){
        echo "<option value='".$fila['id']."'>".$fila['name']."</option>";
    }
}
echo '</select>';


?>