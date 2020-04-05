<?php

$cnx = mysqli_connect("localhost", "root", "", "bd_ambiente_web");
if (!$cnx) {   
    echo "-1";
}else{
    $opcion = $_GET["opcion"];
    switch ($opcion) {
        case "1":
            login($cnx);
        break;
        default:
            # code...
        break;
    }
}//fin del primer else

function login($cnx){
    $username = $_GET["username"];
    $password = $_GET["password"];
    mysqli_set_charset($cnx, "utf8");
    $select = "SELECT * FROM usuarios WHERE nickname_usuario = '$username'";
    $resultado = mysqli_query($cnx, $select);
    if (mysqli_num_rows($resultado) == 1) {
        $usuario = mysqli_fetch_assoc($resultado);
        //mysqli_fetch_assoc() me trae un array asociativo con lo consultado en el select
        $verify = password_verify($password, $usuario['pass_usuario']);
        if ($verify) {
            session_start();
            $_SESSION['usuario'] = $usuario;
            echo "1";
        }else{
            echo "0";
        }
    }else{
        echo "0";
    }//fin del segundo else
}//fin de inserta usuario

?>