<?php

function mostrarErrores($errores, $campo){
    //recoge los datos de los errores y los imprime en un div
    $alerta = '';
    if (isset($errores[$campo]) && !empty($campo)) {
        $alerta = "<div class='alerta'>" .$errores[$campo]."</div>";
    }
    return $alerta;
}

function borrarErrores(){
    $borrado = false;
    if(isset($_SESSION['errores'])){
        $_SESSION['errores'] = null;
        unset($_SESSION['errores']);
    }
    if(isset($_SESSION['completado'])){
        $_SESSION['completado'] = null;
        unset($_SESSION['completado']);
    }
    return $borrado;
}

?>