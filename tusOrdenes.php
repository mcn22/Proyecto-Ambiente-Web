<?php require_once 'includes/conexion.php'?>
<?php require_once "includes/funciones.php" ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d2e44cecd9.js" crossorigin="anonymous"></script>
    <script src="./controladores/validaciones.js" type="text/javascript"></script>
    <script src="./controladores/manejoUsuarios.js" type="text/javascript"></script>
    <script src="./controladores/login.js" type="text/javascript"></script>
    <script src="./controladores/manejoOrdenes.js" type="text/javascript"></script>

    <title>Proyecto Ambiente Web</title>
</head>

<body onload="listarOrdenes()">
    <header>
        <nav>
            <ul>
                <li><?php if (isset($_SESSION['usuario'])) : ?>
                    <a id="hi-usuario" href="usuario.php"><?php echo $_SESSION['usuario']['nombre_usuario'] ?></a>
                    <?php endif; ?>
                </li>
                <li><?php if (isset($_SESSION['usuario'])) : ?>
                    <a href="logout.php">Cerrar Sesión</a>
                    <?php endif; ?></li>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="#" id="login">Login</a></li>
                <li><a href="#" id="registro">Registro</a></li>
                <div class="bg-modal-login">
                    <div class="modal-content">
                        <i class="far fa-window-close close-login"></i>
                        <!--if(!isset($_SESSION['usuario'])) muestra seccion de login si no hay un usuario logueado-->
                        <?php if (!isset($_SESSION['usuario'])) : ?>
                        <div id="login" class="block align-text-center">
                            <h3>Identificate</h3>
                            <form>
                                <input type="text" id="username" placeholder="Nombre de usuario:">
                                <input type="password" id="password" placeholder="Contraseña:">
                                <input type="button" value="Ingresar" onclick="login()">
                            </form>
                        </div>
                        <div class="align-text-center">
                            <h5 id="h5InfoLog"></h5>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
                <div class="bg-modal-registro">
                    <div class="modal-content">
                        <i class="far fa-window-close close-registro"></i>
                        <!--if(!isset($_SESSION['usuario'])) muestra seccion de registro si no hay un usuario logueado-->
                        <?php if (!isset($_SESSION['usuario'])) : ?>
                        <div id="register" class="block align-text-center">
                            <h3>Registrate</h3>
                            <form>
                                <input type="text" id="nombre" placeholder="Nombre:">
                                <input type="text" id="nickname" placeholder="Nickname:">
                                <input type="password" id="pass" placeholder="Contraseña:">
                                <input type="button" value="Registrarse" onclick="registrar()">
                            </form>
                        </div>
                        <div class="align-text-center">
                            <h5 id="h5Info"></h5>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </ul>
        </nav>
        <!-- Dice si usuario esta logeado y quita los botones de loggearse y registro. -->
        <?php if (isset($_SESSION['usuario'])) : ?>
        <script>
        var login = document.getElementById('login');
        login.parentNode.removeChild(login);
        var registro = document.getElementById('registro');
        registro.parentNode.removeChild(registro);
        </script>
        <?php endif;?>
    </header>

    

    <section class="container ">
        <div class="tablas">
        <h2>Lista de ordenes realizadas</h2>   
        <div class="ta" id="campoTabla">        
        </div>
        </div>
        
    </section>

    <section class="container ">
        <div class="tablas">
        <h2>Detalle de la compra</h2>    
        <div class="ta" id="detalle">                 
        </div>
        </div>
        
    </section>


    </main>
    <?php require_once 'includes/footer.php'; ?>
</body>

</html>