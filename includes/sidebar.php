<?php require_once "includes/funciones.php"?>

<aside id="lateral">

        <?php if(isset($_SESSION['usuario'])) : ?>
            <div class="block">
                <h3>Bienvenido <?php $_SESSION['usuario']['nombre_usuario']?></h3>
            </div>
        <?php endif; ?>

        <div id="login" class="block">
            <h3>Identificate</h3>
            <form method="POST" action="login.php">
                <label for="username">Nombre de usuario:</label>
                <input type="text" name="username">
                <label for="password">Contraseña:</label>
                <input type="password" name="password">
                <button type="submit" name="submit">Ingresar</button>
            </form>
        </div>
        <div id="register" class="block">
            <h3>Registrate</h3>
            <?php if(isset($_SESSION['completado'])): ?>
            <div>
                <?=$_SESSION['completado']?>
            </div>
            <?php elseif(isset($_SESSION['errores']['general'])): ?>
            <div>
            <?=$_SESSION['errores']['general']?>
            </div>
            <?php endif; ?>
            <form action="registro.php" method="POST">

                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre">
                <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'nombre'): ''?>

                <label for="username">Nombre de usuario:</label>
                <input type="text" name="username">
                <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'username'): ''?>

                <label for="password">Contraseña:</label>
                <input type="password" name="password">
                <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'password'): ''?>

                <button type="submit" name="submit">Registrar</button>
                
            </form>
            <?php borrarErrores()?>
        </div>
        <div class="block">
            <h2>Categorías</h2>
            <ul id="menuLateral">
                <li><a href="#">Categoria 1</a></li>
                <li><a href="#">Categoria 2</a></li>
                <li><a href="#">Categoria 3</a></li>
                <li><a href="#">Categoria 4</a></li>
                <li><a href="#">Categoria 5</a></li>
            </ul>
        </div>
</aside>