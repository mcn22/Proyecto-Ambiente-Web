<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/estilos.css">
    <script src="../controladores/validaciones.js" type="text/javascript"></script>
    <script src="../controladores/manejoUsuarios.js" type="text/javascript"></script>
    <script src="../controladores/login.js" type="text/javascript"></script>
    <title>Subir Producto</title>
</head>

<body onload="revisaSesion()">
    <div class="header">
        <nav>
            <ul id="menuTop">
                <li><a href="../index.html">Inicio</a></li>
                <li><a href="../tienda.html">Tienda</a></li>
            </ul>
        </nav>
    </div>
    <div class="section container align-text-center pt-10">
        <form action="" method="post" enctype="multipart/form-data">
            <h4>Sube un producto</h4>
            <input type="text" name="nombre" id="nombre" placeholder="nombre">
            <br>
            <input type="text" name="descripccion" id="descripccion" placeholder="descripccion">
            <br>
            <input type="number" name="precio" id="precio" placeholder="precio">
            <br>
            <input type="number" name="cantVenta" id="cantVenta" placeholder="cantidad">
            <br>
            <input type="file" name="imagen" id="imagen" placeholder="imagen">
            <br>
            <input type="submit" value="submit" name="submit" id="submit" class="botones">
            <h3 id=infoUpload></h3>
        </form>
    </div>
    <div class="footer">
        <p id="derechosReservados">
            Copyright &copy;
            <script>document.write(new Date().getFullYear());</script> All rights reserved
        </p>
    </div>
    <!--Script que crea la funcion para la impresion de la informacion de la carga de datos en la pantalla-->
    <script language="javascript" type="text/javascript">
        function imprimeInfo(texto) {
            console.log(texto);
            if (texto == 1) {
                document.getElementById('infoUpload').innerHTML = "Éxito al subir los datos";
            } else {
                document.getElementById('infoUpload').innerHTML = "Falló la carga de datos...";
            }
        }//fin de la funcion
    </script>
    <!--Codigo php que inserta los datos en la base de datos-->
    <?php
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'bd_ambiente_web';
    $db = mysqli_connect($server, $username, $password, $database);

    mysqli_query($db, "SET NAMES 'utf8'");
    session_start();

    if (isset($_POST['submit'])) {
        $nombre = strtolower($_POST['nombre']);
        $desc = $_POST['descripccion'];
        $precio = $_POST['precio'];
        $imagen = $_FILES['imagen']['name'];
        $cantidad = $_POST['cantVenta'];
        $imagenTMP = $_FILES['imagen']['tmp_name'];

        $folder = "../imagenesProductos/";
        move_uploaded_file($imagenTMP, $folder . $imagen);

        $sql = "INSERT INTO `producto`(`nombre`, `descripccion`, `precio`, `imageName`,`cantVenta`) VALUES ('$nombre','$desc','$precio','$imagen',$cantidad)";
        $qry = mysqli_query($db, $sql);
        //Lanza la funcion de javascript anterior 
        if ($qry) {
            echo "<script>";
            echo "imprimeInfo(1);";
            echo "</script>";
        } elseif (!$qry) {       
            echo "<script>";
            echo "imprimeInfo(0);";
            echo "</script>";
        }
    }
    ?>
</body>

</html>