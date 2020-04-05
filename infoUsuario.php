<?php require_once 'includes/header.php'; ?>

<section class="container">
<div class=" info_user">
    <h2 id="h2-nosotros">Cambiar tus datos</h2>
    <div class="align-text-center">
        <h3>Tu nombre es <?php echo $_SESSION['usuario']['nombre_usuario']?>.</h3>
        <input type="text" id="nuevoNombre">
        <input type="button" value="Cambiar" onclick="cambioNombre()">
        <h3>Tu nickname es <?php echo $_SESSION['usuario']['nickname_usuario']?>.</h3>
        <input type="text" id="nuevoNick">
        <input type="button" value="Cambiar" onclick="cambioNick()">       
        <h3>Cambio de contraseña.</h3>
        <input type="password" id="viejoPass" placeholder="Contraseña anterior...">
        <input type="password" id="nuevoPass" placeholder="Contraseña nueva...">
        <input type="button" value="Cambiar" onclick="cambioPass()"> 
        <h5 id="h5InfoCambio"></h5>
    </div>
</div>
</section>
<section class="container">
<div class=" info_user">
    <h2 id="h2-nosotros">Eliminar cuenta</h2>
    <div class="align-text-center">
        <input type="button" value="Eliminar" onclick="eliminaCuenta()">
    </div>
</div>
</section>

</main>
<?php require_once 'includes/footer.php'; ?>
</body>

</html>