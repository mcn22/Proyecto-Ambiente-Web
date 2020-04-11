<?php
$nombreProducto = strtolower($_GET['nombre']);
$db = mysqli_connect('localhost', 'root', '', 'bd_ambiente_web');
if($nombreProducto == ""){
    $select = "SELECT * FROM `producto`";  
    $query = mysqli_query($db, $select);
    $datos = array();  
    while ($row = mysqli_fetch_assoc($query)) {
        $datos[] = $row;
    }//fin del while   
}else{
    $select = "SELECT * FROM `producto` WHERE nombre = '$nombreProducto'";
    $query = mysqli_query($db, $select);
    $datos = array();
    while ($row = mysqli_fetch_assoc($query)) {
        $datos[] = $row;
    }//fin del while
}//fin del else

echo json_encode($datos);
?>