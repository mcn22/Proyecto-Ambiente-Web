<?php

//inicia la sesion y conecta con la bd
require_once 'includes/conexion.php';

if(isset($_POST)){
    
    if (isset($_SESSION['error_login'])) {
        unset($_SESSION['error_login']);
        //borra la sesion de error cuando ya no hay error
    }  

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE nickname_usuario = '$username'";
    $login = mysqli_query($db, $sql);

    if ($login && mysqli_num_rows($login) == 1) {
        $usuario = mysqli_fetch_assoc($login);
        $_SESSION['user_id'] = $usuario['id_usuario'];
        //mysqli_fetch_assoc() me trae un array asociativo con lo consultado en el select
        $verify = password_verify($password, $usuario['pass_usuario']);
        //password_verify() desencripta el password de la base de datos y lo compara, devueve booleano
        if ($verify) {
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