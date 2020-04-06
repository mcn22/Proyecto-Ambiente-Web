'use strict'

function listarOrdenes(){
    var comm = new XMLHttpRequest();
    comm.open("GET","./modelo/manejoOrdenes.php?opcion=1",true);
    comm.send(null);
    comm.onreadystatechange = function(){
        if(comm.readyState == 4 && comm.status == 200){
            var campoTabla = document.getElementById('campoTabla');
            var info = document.createElement('h5');
            info.setAttribute('id', 'info');
            campoTabla.appendChild(info);
            switch (comm.responseText) {
                case "-1":
                    document.getElementById("info").innerHTML = "Error de conexión...";
                    break;
                case "0":
                    document.getElementById("info").innerHTML = "No has realizado una compra...";
                    break;                                        
                default:                   
                    var listaOrdenJSON = JSON.parse(comm.responseText);                  
                    agregarElementoListaOrdenes(listaOrdenJSON);
                break;
            }//fin del switch
        }//fin del if de obtencion de resultados
    }//fin del onreadystatechange
}//fin de listar ordenes

function agregarElementoListaOrdenes(listaOrdenJSON){
    creaTablaSuperiorListaOrdenes();
    var tablaLista = document.getElementById('tablaOrden');
    for (var indice in listaOrdenJSON ) {

        var tr = document.createElement('TR');   
        var tdID = document.createElement('TD');
        tdID.appendChild(document.createTextNode(listaOrdenJSON[indice].ID_ORDEN));
        var tdTotal = document.createElement('TD');
        tdTotal.appendChild(document.createTextNode(listaOrdenJSON[indice].TOTAL));

        var tdBoton = document.createElement('BUTTON');
        tdBoton.setAttribute("value",listaOrdenJSON[indice].ID_ORDEN);
        tdBoton.setAttribute("type","button");
        tdBoton.setAttribute("class","botonTabla");
        var funcionAlCLick = "detalle("+listaOrdenJSON[indice].ID_ORDEN+")";
        tdBoton.setAttribute("onclick", funcionAlCLick);
        tdBoton.appendChild(document.createTextNode("Visualizar"));

        tr.appendChild(tdID);
        tr.appendChild(tdTotal);
        tr.appendChild(tdBoton);
        tablaLista.appendChild(tr);
    }//fin del for
}//fin de agregar elemento

function creaTablaSuperiorListaOrdenes(){
    var campoTabla = document.getElementById('campoTabla');
    var tabla = document.createElement('TABLE');
    tabla.setAttribute("class","ta");
    tabla.setAttribute("class","mt-5");
    var thead = document.createElement('THEAD');
    var trHead = document.createElement('TR');

    var thID = document.createElement('TH');
    thID.appendChild(document.createTextNode("Id de orden"));
    var thTotal = document.createElement('TH');
    thTotal.appendChild(document.createTextNode("Total de compra"));
    var thDetalle = document.createElement('TH');
    thDetalle.appendChild(document.createTextNode("Ver detalle"));

    trHead.appendChild(thID);
    trHead.appendChild(thTotal);
    trHead.appendChild(thDetalle);
    thead.appendChild(trHead);
    tabla.appendChild(thead);

    var tbody = document.createElement('tbody');
    tbody.setAttribute('id','tablaOrden');
    tbody.setAttribute('class','ta');

    tabla.appendChild(tbody);

    campoTabla.appendChild(tabla);
}//fin de la creacion de la parte superior de la tabla de la lista de las ordenes

function detalle(idOrden){
    var comm = new XMLHttpRequest();
    comm.open("GET","./modelo/manejoOrdenes.php?opcion=2&idOrden="+idOrden,true);
    comm.send(null);
    comm.onreadystatechange = function(){
        if(comm.readyState == 4 && comm.status == 200){
            switch (comm.responseText) {
                case "-1":
                    document.getElementById("info").innerHTML = "Error de conexión...";
                    break;
                case "0":
                    document.getElementById("info").innerHTML = "Hubo un error...";
                    break;                                        
                default:     
                    var campoTabla = document.getElementById('detalle');
                    campoTabla.innerHTML = "";              
                    var listaDetalleJSON = JSON.parse(comm.responseText);   
                    agregarElementoListaDetalle(listaDetalleJSON);         
                break;
            }//fin del switch
        }//fin del if de obtencion de resultados
    }//fin del onreadystatechange
}//fin del detalle de las ordenes

function agregarElementoListaDetalle(listaDetalleJSON){
    creaTablaSuperiorListaDetalle();
    var tablaLista = document.getElementById('tablaDetalle');
    for (var indice in listaDetalleJSON ) {
        var tr = document.createElement('TR');   
        var tdNombre = document.createElement('TD');
        tdNombre.appendChild(document.createTextNode(listaDetalleJSON[indice].nombre));
        var tdprecio = document.createElement('TD');
        tdprecio.appendChild(document.createTextNode(listaDetalleJSON[indice].precio));
        var tdCant = document.createElement('TD');
        tdCant.appendChild(document.createTextNode(listaDetalleJSON[indice].CANTIDAD));
        var tdCosto = document.createElement('TD');
        tdCosto.appendChild(document.createTextNode(listaDetalleJSON[indice].COSTO));

        tr.appendChild(tdNombre);
        tr.appendChild(tdprecio);
        tr.appendChild(tdCant);
        tr.appendChild(tdCosto);
        
        tablaLista.appendChild(tr);
    }//fin del for
}//fin de agregar elemento

function creaTablaSuperiorListaDetalle(){
    var campoTabla = document.getElementById('detalle');
    var tabla = document.createElement('TABLE');
    tabla.setAttribute("class","ta");
    tabla.setAttribute("class","mt-5");
    var thead = document.createElement('THEAD');
    var trHead = document.createElement('TR');

    var thNomb = document.createElement('TH');
    thNomb.appendChild(document.createTextNode("Nombre de Producto"));
    var thUnid = document.createElement('TH');
    thUnid.appendChild(document.createTextNode("Precio unidad"));
    var thCant = document.createElement('TH');
    thCant.appendChild(document.createTextNode("Cantidad"));
    var thTotal = document.createElement('TH');
    thTotal.appendChild(document.createTextNode("Total"));

    trHead.appendChild(thNomb);
    trHead.appendChild(thUnid);
    trHead.appendChild(thCant);
    trHead.appendChild(thTotal);
    thead.appendChild(trHead);
    tabla.appendChild(thead);

    var tbody = document.createElement('tbody');
    tbody.setAttribute('id','tablaDetalle');
    tbody.setAttribute('class','ta');

    tabla.appendChild(tbody);

    campoTabla.appendChild(tabla);
}//fin de la creacion de la parte superior de la tabla de la lista de las ordenes

