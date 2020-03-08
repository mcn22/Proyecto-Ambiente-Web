<?php

/*
CREATE TABLE `bd_ambiente_web`.`usuarios` ( 
    `id_usuario` INT(100) NOT NULL AUTO_INCREMENT, 
    `nombre_usuario` VARCHAR(20) NOT NULL, 
    `nickname_usuario` VARCHAR(15) NOT NULL, 
    `pass_usuario` VARCHAR(60) NOT NULL, 
    PRIMARY KEY (`id_usuario`))
*/

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'bd_ambiente_web';

$db = mysqli_connect($server, $username, $password, $database);

mysqli_query($db, "SET NAMES 'utf8'");

session_start();

?> 
