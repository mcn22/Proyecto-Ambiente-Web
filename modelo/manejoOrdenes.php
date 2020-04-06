<?php

$cnx = mysqli_connect("localhost", "root", "", "bd_ambiente_web");
if (!$cnx) {   
    echo "-1";
}else{
    session_start();
    $opcion = $_GET["opcion"];
    switch ($opcion) {
        case "1":
            listaOrdenes($cnx);
        break;
        case "2":
            listaDetalle($cnx);
        break;
        default:
            # code...
        break;
    }
}//fin del primer else

function listaOrdenes($cnx){
    mysqli_set_charset($cnx, "utf8");
    $idUser = $_SESSION['usuario']['id_usuario'];
    $select = "SELECT * FROM `orden` WHERE ID_USUARIO = $idUser";
    $resultado = mysqli_query($cnx, $select);
    if (mysqli_num_rows($resultado) > 0) {			
		$listaOrdenes = array();
		while($row = mysqli_fetch_assoc($resultado)){
				$listaOrdenes[] = $row;
			}//fin del while
			header('Content-Type: application/json');
			echo json_encode($listaOrdenes);
	}else{
		echo "0";   
	}//fin del else
}//fin de listar ordenes

function listaDetalle($cnx){
    mysqli_set_charset($cnx, "utf8");
    $idOrden = $_GET['idOrden'];
    $select = "SELECT nombre, precio, CANTIDAD, COSTO from detalleorden 
    inner join producto on producto.idProducto = detalleorden.ID_PROD
    WHERE detalleorden.ID_ORDEN = $idOrden";
    $resultado = mysqli_query($cnx, $select);
    if (mysqli_num_rows($resultado) > 0) {			
		$listaDetalle = array();
		while($row = mysqli_fetch_assoc($resultado)){
				$listaDetalle[] = $row;
			}//fin del while
			header('Content-Type: application/json');
			echo json_encode($listaDetalle);
	}else{
		echo "0";   
    }//fin del else
}//fin de listar el detalle de las ordenes

?>