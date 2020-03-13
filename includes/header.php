<?php require_once 'conexion.php' ?>
<?php require_once "includes/funciones.php" ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d2e44cecd9.js" crossorigin="anonymous"></script>
    <title>Proyecto Ambiente Web</title>
</head>

<body>
    <header>
        
            <nav>
                <ul>
                    <li><?php if (isset($_SESSION['usuario'])) : ?>

                            <a id="hi-usuario">Bienvenido <?php echo $_SESSION['usuario']['nombre_usuario'] ?></a>

                        <?php endif; ?>
                    </li>
                    <li><?php if (isset($_SESSION['usuario'])) : ?>
                            <a href="logout.php">Cerrar Sesión</a>
                        <?php endif; ?></li>
                    <li><a href="index.php">Inicio</a></li>
                    <!-- <li><a href="#">Sobre Nosotros</a></li>
                    <li><a href="#">Productos</a></li> -->
                    <li><a href="#" id="login">Login</a></li>
                    <li><a href="#" id="registro">Registro</a></li>




                    <div class="bg-modal-login">
                        <div class="modal-content">
                        <i class="far fa-window-close close-login"></i>


                            <!--if(!isset($_SESSION['usuario'])) muestra seccion de login si no hay un usuario logueado-->
                            <?php if (!isset($_SESSION['usuario'])) : ?>

                                <div id="login" class="block">
                                    <h3 id="login">Identificate</h3>
                                    <?php echo isset($_SESSION['error_login']) ? $_SESSION['error_login'] : '' ?>
                                    <!--if ternario-->
                                    <form method="POST" action="login.php">
                                        <input type="text" name="username" placeholder="Nombre de usuario:">
                                        <input type="password" name="password" placeholder="Contraseña:">
                                        <input type="submit" name="submit"></input>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div> 



                    <div class="bg-modal-registro">
                        <div class="modal-content">
                        <i class="far fa-window-close close-registro"></i>


                            <!--if(!isset($_SESSION['usuario'])) muestra seccion de registro si no hay un usuario logueado-->
                            <?php if (!isset($_SESSION['usuario'])) : ?>
                                <div id="register" class="block">
                                    <h3 id="registro">Registrate</h3>
                                    <?php if (isset($_SESSION['completado'])) : ?>
                                        <div>
                                            <?= $_SESSION['completado'] ?>
                                        </div>
                                    <?php elseif (isset($_SESSION['errores']['general'])) : ?>
                                        <div>
                                            <?= $_SESSION['errores']['general'] ?>
                                        </div>
                                    <?php endif; ?>
                                    <form action="registro.php" method="POST">

                                        <input type="text" name="nombre" placeholder="Nombre:">
                                        <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'nombre') : '' ?>

                                        <input type="text" name="username" placeholder="Nombre de usuario:">
                                        <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'username') : '' ?>

                                        <input type="password" name="password" placeholder="Contraseña:">
                                        <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'password') : '' ?>

                                        <input type="submit" name="submit"></input>

                                    </form>
                                    <?php borrarErrores() ?>
                                </div>
                            <?php endif; ?>
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
        <?php endif; ?>

        <!-- Manejan el modal para login y registro: -->
        <script>
            document.getElementById('login').addEventListener('click', ()=>{
                document.querySelector('.bg-modal-login').style.display = 'flex';
            });

            document.getElementById('registro').addEventListener('click', ()=>{
                document.querySelector('.bg-modal-registro').style.display = 'flex';
            });
            document.querySelector('.close-login').addEventListener('click', ()=>{
                document.querySelector('.bg-modal-login').style.display = 'none';
            });
            document.querySelector('.close-registro').addEventListener('click', ()=>{
                document.querySelector('.bg-modal-registro').style.display = 'none';
            });
        </script>
    </header>