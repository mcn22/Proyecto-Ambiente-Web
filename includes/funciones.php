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
    $_SESSION['errores'] = null;
    $borrado = session_unset();
    return $borrado;
}

?>