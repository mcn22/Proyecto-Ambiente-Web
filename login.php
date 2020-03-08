<?php

//inicia la sesion y conecta con la bd
require_once 'includes/conexion.php';

if(isset($_POST)){
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE nickname_usuario = '$username'";
    $login = mysqli_query($db, $sql);

    if ($login && mysqli_num_rows($login) == 1) {
        $usuario = mysqli_fetch_assoc($login);
        //mysqli_fetch_assoc() me trae un array asociativo con lo consultado en el select
        $md5pass = md5($password);
        $verificacion = password_verify($md5pass, $usuario['pass_usuario']);

        if ($verificacion) {
            $_SESSION['usuario'] = $usuario;

           
        }else{
            $_SESSION['error_login'] = "Login incorrecto";
        }
        
    }else{
        $_SESSION['error_login'] = "Login incorrecto";
    }


}

//redirigir al index
header('Location: index.php');

?>