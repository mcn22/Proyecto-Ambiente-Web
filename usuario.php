<?php require_once 'includes/header.php'; ?>

<section class="container">
<div class=" info_user">
    <h2 id="h2-nosotros"><?php echo $_SESSION['usuario']['nombre_usuario']?> acá están tus datos.</h2>
    <div class="align-text-center">
        <a href="infoUsuario.php"><input type="button" value="Cambiar datos personales"></a>
        <a href="tusOrdenes.php"><input type="button" value="Ver ordenes realizadas"></a>
    </div>
</div>
</section>
</main>
<?php require_once 'includes/footer.php'; ?>
</body>

</html>