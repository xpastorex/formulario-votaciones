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
        <form onsubmit="return handleData()" method="post">
            <div id="content">
                <span>Nombre y Apellido</span>
                <input type="text" required>
            </div>
            <div id="content">
                <span>Alias</span>
                <input type="text" required>
            </div>
            <div id="content">
                <span>RUT</span>
                <input type="text" required>
            </div>
            <div id="content">
                <span>Email</span>
                <input type="email" required>
            </div>
            <div id="content">
                <span>Region</span>
                <select name="region" required onclick="mostrarSelect(this.value)">
                    <option selected hidden value="">--Region--</option>
                    <!-- Añadir codigo php para añadir las regiones -->
                </select>
            </div>
            <div id="content">
                <span>Comuna</span>
                <div id="comunas">
                    <select name="comuna" required>
                        <option selected hidden value="">--Comuna--</option>
                        <!-- Añadir codigo php para añadir las comunas -->

                    </select>
                </div>
            </div>
            <div id="content">
                <span>Candidato</span>
                <select name="candidato" required>
                    <option selected hidden value="">--Candidato--</option>
                    <!-- Añadir codigo php para añadir los candidatos -->

                </select>
            </div>
            <div id="content">
                <span>Como se enteró de Nosotros</span>
                <div class="nosotros">
                    <div>
                        <input name="langs[]" type="checkbox" name="web">
                        <span>Web</span>
                    </div>
                    <div>
                        <input name="langs[]" type="checkbox" name="tv">
                        <span>TV</span>
                    </div>
                    <div>
                        <input name="langs[]" type="checkbox" name="redes">
                        <span>Redes Sociales</span>
                    </div>
                    <div>
                        <input name="langs[]" type="checkbox" name="amigo">
                        <span>Amigo</span>
                    </div>
                </div>
            </div>
            <div style="display:none; color:red; " id="chk_option_error">
                Por favor, seleccione al menos dos opciones
            </div>
            <input type="submit" name="submit" value="Enviar" />
        </form>
    </section>

    <script>
        function handleData() {
            var form_data = new FormData(document.querySelector("form"));

            //Metodo para validar si hay mas de 2 checkbox seleccionados
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

            conexion.open("GET" , "comunas.php?c=" + str , true);
            conexion.send();

        }
    </script>
</body>

</html>