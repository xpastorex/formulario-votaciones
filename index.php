<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Formulario Votaciones</title>
</head>

<body>
    <section>
        <!-- Formulario -->
        <form action="resultado.php" onsubmit="return handleData()" method="post">
            <h1>FORMULARIO DE VOTACIÓN</h1>
            <div id="content">
                <span>Nombre y Apellido</span>
                <input type="text" required name="nombre">
            </div>
            <div id="content">
                <span>Alias</span>
                <input type="text" maxlength="12" required name="alias" pattern="^(?=.*[a-zA-Z])(?=\w*[0-9])\w{5,12}$"
                    title="El alias debe contener al menos un numero y un digito, y tener al menos 5 caracteres (no están permitidos los caracteres especiales)">
            </div>
            <div id="content">
                <span>RUT</span>
                <input type="text" required name="rut" pattern="\d{3,8}-[\d|kK]{1}" title="Debe ser un Rut válido">
            </div>
            <div id="content">
                <span>Email</span>
                <input type="email" required name="email">
            </div>
            <div id="content">
                <span>Region</span>
                <select name="region" required onclick="mostrarSelect(this.value)">
                    <option selected hidden value="">--Region--</option>
                    <!-- Se llena el select de regiones mediante el archivop region.php -->
                    <?php include "region.php" ?>
                </select>
            </div>
            <div id="content">
                <span>Comuna</span>
                <div id="comunas">
                    <select name="comuna" id="select" required>
                        <option selected hidden value="">--Comuna--</option>
                        <!-- Las opciones del select columnas se añaden mediante la function mostrarSelect(), la cual hace una consulta en la base de datos para poder llamar a estos de manera dinamica-->

                    </select>
                </div>
            </div>
            <div id="content">
                <span>Candidato</span>
                <select name="candidato" required>
                    <option selected hidden value="">--Candidato--</option>
                    <!-- Se llena el select de candidatos mediante el archivo candidatos.php el cual hace una consulta a la base de datos -->
                    <?php include "candidatos.php" ?>

                </select>
            </div>
            <div id="content">
                <span>Como se enteró de Nosotros</span>
                <div class="nosotros">
                    <div>
                        <input name="langs[]" type="checkbox" value="Web">
                        <span>Web</span>
                    </div>
                    <div>
                        <input name="langs[]" type="checkbox" value="TV">
                        <span>TV</span>
                    </div>
                    <div>
                        <input name="langs[]" type="checkbox" value="Redes Sociales">
                        <span>Redes Sociales</span>
                    </div>
                    <div>
                        <input name="langs[]" type="checkbox" value="Amigo">
                        <span>Amigo</span>
                    </div>
                </div>
            </div>
            <div style="display:none; color:red; " id="chk_option_error">
                Por favor, seleccione al menos dos opciones
            </div>
            <input class="enviar" type="submit" name="submit" value="Enviar" />
        </form>
    </section>

    <script>
        //Funcion la cual se encarga de asegurar que hayan al menos 2 checkbox de "Como se enteró de nosotros" seleccionados para poder enviar el formulario
        function handleData() {
            var form_data = new FormData(document.querySelector("form"));
            if (form_data.getAll("langs[]").length < 2) {
                document.getElementById("chk_option_error").style.display = "flex";
                return false;
            }
            else {
                document.getElementById("chk_option_error").style.display = "none";
                return true;
            }

        }
    </script>

    <script type="text/javascript">
        //Funcion que se encarga de llenar el select de comunas en base a la region que se selecciona
        function mostrarSelect(str) {
            var conexion;

            if (str == "") {
                document.getElementById("txtHint").innerHTML = ""
                return
            }

            if (window.XMLHttpRequest) {
                conexion = new XMLHttpRequest();
            }

            conexion.onreadystatechange = function () {
                if (conexion.readyState == 4 && conexion.status == 200) {
                    document.getElementById("comunas").innerHTML = conexion.responseText;
                }
            }
            conexion.open("GET", "comunas.php?c=" + str, true);
            conexion.send();
        }
    </script>
</body>

</html>