<?php

$cnx = mysqli_connect("localhost", "root", "", "bd_ambiente_web");
if (!$cnx) {   
    echo "-1";
}else{
    session_start();
    $opcion = $_GET["opcion"];
    switch ($opcion) {
        case "1":
            insertaUsuario($cnx);
        break;
        case "2":
            cambioNombre($cnx);
        break;
        case "3":
            cambioNick($cnx);
        break;
        case "4":
            cambioPass($cnx);
        break;
        case "5":
            eliminaCuenta($cnx);
        break;
        case "6":
            revisaSesion();
        break;
        case "7":
            revisaTipoUsuario();
        break;
        case "8":
            devuelveNombreYNick();
        break;   
        case "9":
            cierraSesion();
        break;     
        default:
            # code...
        break;
    }
}//fin del primer else

function insertaUsuario($cnx){
    $nombre = $_GET["nombre"];
    $nickname = $_GET["nickname"];
    $pass = $_GET["pass"];
    mysqli_set_charset($cnx, "utf8");
    $pass_cifrado = password_hash($pass, PASSWORD_BCRYPT, ['cost'=>4]);
    $insert = "INSERT INTO `usuarios`(`nombre_usuario`, `nickname_usuario`,`pass_usuario`) VALUES ('$nombre','$nickname', '$pass_cifrado')";
    $resultado = mysqli_query($cnx, $insert);
    if ($resultado) {
        echo "1";
    }else{
        echo "0";
    }//fin del segundo else
}//fin de inserta usuario

function cambioNombre($cnx){
    $nombre = $_GET["cambioNombre"];
    $idUser = $_SESSION['usuario']['id_usuario'];
    mysqli_set_charset($cnx, "utf8");
    $update = "UPDATE `usuarios` SET  `nombre_usuario` = '$nombre' WHERE `id_usuario` = $idUser";
    $resultado = mysqli_query($cnx, $update);
    if ($resultado) {
        $_SESSION['usuario']['nombre_usuario'] = $nombre;
        echo "1";
    }else{
        echo "0";
    }//fin del segundo else
}//fin de cambio de nombre

function cambioNick($cnx){
    $nick = $_GET["cambioNick"];
    $idUser = $_SESSION['usuario']['id_usuario'];
    mysqli_set_charset($cnx, "utf8");
    $update = "UPDATE `usuarios` SET  `nickname_usuario` = '$nick' WHERE `id_usuario` = $idUser";
    $resultado = mysqli_query($cnx, $update);
    if ($resultado) {
        $_SESSION['usuario']['nickname_usuario'] = $nick;
        echo "1";
    }else{
        echo "0";
    }//fin del segundo else
}//fin de cambia nick

function cambioPass($cnx){
    $viejoPass = $_GET["viejoPass"];
    $nuevoPass = $_GET["nuevoPass"];
    $idUser = $_SESSION['usuario']['id_usuario'];
    mysqli_set_charset($cnx, "utf8");
    $verify = password_verify($viejoPass, $_SESSION['usuario']['pass_usuario']);
        if ($verify) {
            $pass_cifrado = password_hash($nuevoPass, PASSWORD_BCRYPT, ['cost'=>4]);
            $update = "UPDATE `usuarios` SET  `pass_usuario` = '$pass_cifrado' WHERE `id_usuario` = $idUser";
            $resultado = mysqli_query($cnx, $update);
            if ($resultado) {
                $_SESSION['usuario']['pass_usuario'] = $pass_cifrado;
                echo "1";
            }else{
                echo "0";
            }//fin del segundo else
        }else{
            echo "2";
        }
}//fin de cambio del pass

function eliminaCuenta($cnx){
    mysqli_set_charset($cnx, "utf8");
    $idUser = $_SESSION['usuario']['id_usuario'];
    $delete = "DELETE FROM `usuarios` WHERE `id_usuario` = $idUser";
    $resultado = mysqli_query($cnx, $delete);
    if ($resultado) {
        session_unset();
        session_destroy();
        echo "1";
    }else{
        echo "0";
    }//fin del segundo else
}//fin de cambio del pass

function revisaSesion(){
    if(isset($_SESSION['usuario'])){
        $datosUsuario = array(
            'nombre_usuario' => $_SESSION['usuario']['nombre_usuario'],
            'tipoUsuario' => $_SESSION['usuario']['tipoUsuario']);
        echo json_encode($datosUsuario, JSON_FORCE_OBJECT);
    }else{
        echo "0";
    }
}//fin de la revision de la sesion

function devuelveNombreYNick(){
    if(isset($_SESSION['usuario'])){
        $datosUsuario = array(
            'nombre_usuario' => $_SESSION['usuario']['nombre_usuario'],
            'nickname_usuario' => $_SESSION['usuario']['nickname_usuario']);
        echo json_encode($datosUsuario, JSON_FORCE_OBJECT);
    }else{
        echo "0";
    }
}//fin de la devolucion del nick y el nombre

function cierraSesion(){
    if(isset($_SESSION['usuario'])){
        session_unset();
        session_destroy();
        echo "1";
    }else{
        echo "0";
    }
}//fin del cerrado de la sesion

?>