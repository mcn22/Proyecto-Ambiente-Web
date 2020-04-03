<?php

$cnx = mysqli_connect("localhost", "root", "", "bd_ambiente_web");
if (!$cnx) {   
    echo "-1";
}else{
    $opcion = $_GET["opcion"];
    switch ($opcion) {
        case "1":
            insertaUsuario($cnx);
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

?>