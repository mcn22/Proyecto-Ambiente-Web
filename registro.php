<?php

if (isset($_POST)) {

    //inicia la sesion y conecta con la bd
    require_once 'includes/conexion.php';

    if (!$_SESSION) {
        session_start();
    }

    //Operadores ternarios para asignacion de variables recogidas por post
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre'])  : false;
    $username = isset($_POST['username']) ? mysqli_real_escape_string($db, trim($_POST['username'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false; 
    //mysqli_real_escape_string() evita posibles inyecciones de sql leyendo el parametro como un simple string y no como parte de la consulta sql

    
    //array de recoleccion de errores
    $errores = array();

    //validacion del nombre
    if (!empty($nombre) 
    && !is_numeric($nombre)
    && !preg_match("/[0-9]/", $nombre)
    && strlen($nombre)  < 20) {
        $nombre_valido = true;
    }else {
        $nombre_valido = false;
        $errores['nombre'] = "El nombre no es válido";
    }

    //validacion del nombre de usuario
    if (!empty($username) && strlen($username) < 15) {
        $username_valido = true;
    }else {
        $username_valido = false;
        $errores['username'] = "El nombre de usuario no es válido";
    }

    //validacion de la contrasena
    if (!empty($password) && strlen($password)  < 30) {
        $password_valido = true;
    }else {
        $password_valido = false;
        $errores['password'] = "La contraseña no es válida";
    }


    $guardar_usuario = false;
    if(count($errores) == 0){
        $guardar_usuario = true;
        //insercion del usuario en la base de datos
        $md5pass = md5($password);

        $sql = "INSERT INTO usuarios (nombre_usuario, nickname_usuario, pass_usuario)
        VALUES ('$nombre', '$username', '$md5pass')";
        $ejecutar_guardar = mysqli_query($db, $sql);

        //var_dump(mysqli_error($db));
        //(comprobar errores ^^)

        if ($ejecutar_guardar) {
            $_SESSION['completado'] = "El registro se completó con éxito!";
            
        }else{
            $_SESSION['errores']['general'] = "Fallo al guardar el usuario!";          
        }
    }
    else{
        //guarda el array de errores en sesion para recuperarlos si se requiere
        $_SESSION['errores'] = $errores;
    }

}//fin del if isset del post

//redirigir al index
header('Location: index.php');

?>