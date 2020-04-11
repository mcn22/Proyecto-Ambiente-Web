<?php

$cnx = mysqli_connect("localhost", "root", "", "bd_ambiente_web");
if (!$cnx) {   
    echo "-1";
}else{
    session_start();
    $opcion = $_GET["opcion"];
    switch ($opcion) {
        case "0":
            agregarAlCarrito($cnx);
        break;
        case "1":
            listaOrdenes($cnx);
        break;
        case "2":
            listaDetalle($cnx);
        break;
        case "3":
            listarProductos($cnx);
        break;
        case "4":
            listarCarrito($cnx);
        break;
        case "5":
            confirmaCompra($cnx);
        break;
        default:
            # code...
        break;
    }
}//fin del primer else

function agregarAlCarrito($cnx){
    mysqli_set_charset($cnx, "utf8");
    if(isset($_SESSION['usuario'])){
        $idUser = $_SESSION['usuario']['id_usuario'];
        $idProd = $_GET['idProd'];
        $cant = $_GET['cantidad'];
        $precio =  devuelvePrecio($cnx, $idProd, $cant);
        $insert = "INSERT INTO `carrito`(`ID_USUARIO`, `ID_PROD`, `CANTIDAD`, `TOTAL`) 
        VALUES ($idUser,$idProd,$cant,$precio)";
        $resultado = mysqli_query($cnx, $insert);
        if ($resultado) {
            if(actualizaStock($cnx, $idProd, $cant) == 1){
            echo "ok";  
            }
        }else{
            echo "0";
        }//fin del segundo else
    }else{
        echo "2";
    }
}//fin de listar ordenes

function devuelvePrecio($cnx, $idProd, $cant){
    $select = "SELECT precio FROM `producto` WHERE idProducto = $idProd";
    $resultado = mysqli_query($cnx, $select);
    if (mysqli_num_rows($resultado) == 1) {
        $datos = mysqli_fetch_assoc($resultado);
        $precio = $datos['precio']*$cant;
        return $precio;
    }
}//fin del metodo que devuelve el precio para agregar al carrito

function devuelveCantStock($cnx, $idProd){
    $select = "SELECT cantVenta FROM `producto` WHERE idProducto = $idProd";
    $resultado = mysqli_query($cnx, $select);
    if (mysqli_num_rows($resultado) == 1) {
        $datos = mysqli_fetch_assoc($resultado);
        $cantidad = $datos['cantVenta'];
        return $cantidad;
    }
}//fin del metodo que devuelve el precio para actualizarStock

function actualizaStock($cnx, $idProd, $cant){
    $cantidadStock = devuelveCantStock($cnx, $idProd);
    
    $cantidadActualizada = $cantidadStock - $cant;
    $cantidadActualizada ;
    $update = "UPDATE producto SET `cantVenta`= $cantidadActualizada WHERE idProducto = $idProd";
    $resultado = mysqli_query($cnx, $update);
    if ($resultado) {
        return 1;
    }
}//fin del metodo que actualiza el stock reduciendo

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

function listarProductos($cnx){
    mysqli_set_charset($cnx, "utf8");
    $select = "SELECT * FROM `producto` WHERE `cantventa` > 1";
    $resultado = mysqli_query($cnx, $select);
    if (mysqli_num_rows($resultado) > 0) {			
		$listaProductos = array();
		while($row = mysqli_fetch_assoc($resultado)){
				$listaProductos[] = $row;
			}//fin del while
			header('Content-Type: application/json');
			echo json_encode($listaProductos);
	}else{
		echo "0";   
	}//fin del else
}//fin de listar el detalle de las ordenes

function listarCarrito($cnx){
    mysqli_set_charset($cnx, "utf8");
    $idUser = $_SESSION['usuario']['id_usuario'];
    $select = "SELECT nombre, precio, CANTIDAD, TOTAL from carrito 
    inner join producto on producto.idProducto = carrito.ID_PROD
    WHERE ID_USUARIO = $idUser";
    $resultado = mysqli_query($cnx, $select);
    if (mysqli_num_rows($resultado) > 0) {			
		$listaCarrito = array();
		while($row = mysqli_fetch_assoc($resultado)){
            $listaCarrito[] = $row;
			}//fin del while
			header('Content-Type: application/json');
			echo json_encode($listaCarrito);
	}else{
		echo "0";   
	}//fin del else
}//fin de listar carrito

function confirmaCompra($cnx){
    $idOrden = devuelveUltimoIdOrden($cnx);
    mysqli_set_charset($cnx, "utf8");
    $idUser = $_SESSION['usuario']['id_usuario'];
    $direccion = $_GET['direccion'];
    $totalCompra = 0;
    $insertOrden = "INSERT INTO `orden`(`ID_ORDEN`, `ID_USUARIO`, `DIRECCION`, `TOTAL`) VALUES($idOrden,$idUser, '$direccion', 0)";
    $resultadoInsertaOrden = mysqli_query($cnx, $insertOrden);
    if ($resultadoInsertaOrden) {
        $listaCarrito = devuelveCarrito($cnx);
        for ($i = 0; $i < sizeof($listaCarrito); $i++) {
            $idProd = $listaCarrito[$i]['ID_PROD'];
            $cantidad = $listaCarrito[$i]['CANTIDAD'];
            $total =  $listaCarrito[$i]['TOTAL'];
            $totalCompra += $total;
            $insertDetalleOrden = "INSERT INTO `detalleorden`(`ID_ORDEN`, `ID_PROD`, `CANTIDAD`, `COSTO`) VALUES($idOrden,$idProd, $cantidad, $total)";
            mysqli_query($cnx,  $insertDetalleOrden);
        }//fin del for
    }//fin del if
    $updateTotal = "UPDATE orden SET `TOTAL`= $totalCompra WHERE ID_ORDEN = $idOrden";
    $resultadoUpdateTotal = mysqli_query($cnx, $updateTotal);
    if ($resultadoUpdateTotal) {
        vaciarCarrito($cnx, $idUser);
        echo "1";
    }
}//fin de la confirmacion de la compra

function devuelveCarrito($cnx){
    //Devuelve la lista del detalle del carrito para insertarlo en la base de datos del detalle de la orden
    //al confirmar la compra
    mysqli_set_charset($cnx, "utf8");
    $idUser = $_SESSION['usuario']['id_usuario'];
    $select = "SELECT ID_PROD, CANTIDAD, TOTAL from carrito WHERE ID_USUARIO = $idUser";
    $resultado = mysqli_query($cnx, $select);
    if (mysqli_num_rows($resultado) > 0) {			
		$listaCarrito = array();
		while($row = mysqli_fetch_assoc($resultado)){
            $listaCarrito[] = $row;
			}//fin del while
			return $listaCarrito;
	}else{
		echo "0";   
	}//fin del else
}//fin de listar carrito

function devuelveUltimoIdOrden($cnx){
    //esta funcion se lanza para obtener el ultimo id de las ordenes sumandole 1 para agregar la orden siguiente
    //id de orden no es auto increment en la base de datos
    $select = "SELECT max(ID_ORDEN) FROM `orden`";
    $resultado = mysqli_query($cnx, $select);
    if (mysqli_num_rows($resultado) == 1) {
        $datos = mysqli_fetch_assoc($resultado);
        $id = $datos['max(ID_ORDEN)'];
        return $id+1;
    }//fin del if
}//fin del metodo que devuelve el precio para actualizarStock

function vaciarCarrito($cnx, $idUser){
    $delete = "DELETE FROM `carrito` WHERE ID_USUARIO = $idUser";
    mysqli_query($cnx,  $delete);
}//fin de la funcion que borra el carrito el confirmar la compra

?>