<?php 
    $servidor = "localhost";
    $usuario = "root";
    $clave = "";
    $baseDeDatos = "votaciones";

    $enlace = mysqli_connect($servidor , $usuario , $clave , $baseDeDatos);

    if(!$enlace){
        echo"Error en la conexion con el servidor";
    }

    $consulta = "SELECT * FROM candidatos";
    $ejecutarConsulta = mysqli_query($enlace , $consulta);

    while($fila = mysqli_fetch_array($ejecutarConsulta)){
        echo " <option value='".$fila['id']."' >".$fila['nombre']."</option>";
    }

?>