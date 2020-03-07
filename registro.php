<?php

session_start();

if (isset($_POST)) {
    //Operadores ternarios para asignacion de variables recogidas por post
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
    $username = isset($_POST['username']) ? $_POST['username'] : false;
    $password = isset($_POST['password']) ? $_POST['password'] : false; 
    
    //array de recoleccion de errores
    $errores = array();

    //validacion del nombre
    if (!empty($nombre) 
    && !is_numeric($nombre)
    && !preg_match("/[0-9]/", $nombre)
    && count($nombre) < 20) {
        $nombre_valido = true;
    }else {
        $nombre_valido = false;
        $errores['nombre'] = "El nombre no es válido";
    }

    //validacion del nombre de usuario
    if (!empty($username) && count($username) < 15) {
        $username_valido = true;
    }else {
        $username_valido = false;
        $errores['username'] = "El nombre de usuario no es válido";
    }

    //validacion de la contrasena
    if (!empty($password) && count($password) < 30) {
        $password_valido = true;
    }else {
        $password_valido = false;
        $errores['password'] = "La contraseña no es válida";
    }


    $guardar_usuario = false;
    if(count($errores) == 0){
        $guardar_usuario = true;
        //insercion del usuario en la base de datos
        $pass_md5 = md5($password);
    }
    else{
        //guarda el array de errores en sesion para recuperarlos si se requiere
        $_SESSION['errores'] = $errores;
        header('Location: index.php');
    }

}//fin del if isset del post

?>