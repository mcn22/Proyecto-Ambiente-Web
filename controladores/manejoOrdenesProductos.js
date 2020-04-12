'use strict'
/* 
Funciones manejadoras de lo relacionado a los usuarios
1: agregarAlCarrito(); - Linea: 22
2: listarOrdenes(); - Linea: 50
3: agregarElementoListaOrdenes(); - Linea: 76
4: creaTablaSuperiorListaOrdenes(); - Linea: 104
5: detalleOrden(); - Linea: 134
6: agregarElementoListaDetalle(); - Linea: 158
7: creaTablaSuperiorListaDetalle(); - Linea: 181
8: listarProductos(); - Linea: 214
9: creaElementosDeProductos(); - Linea: 236
10: listarProductosCarrito(); - Linea: 298
11: agregarElementoListaCarrito(); - Linea: 320
12: creaTablaSuperiorListaCarrito(); - Linea: 344
13: creaElementosDelCarrito(); - Linea: 380
14: confirmaCompra(); - Linea: 405
13: botonBuscarProductos(); - Linea: 432
14: agregaElementosBusqueda(); - Linea: 450
*/

function agregarAlCarrito(idProducto) {
    var cant = document.getElementById('cant' + idProducto).value;
    var comm = new XMLHttpRequest();
    comm.open("GET", "./modelo/manejoOrdenesProductos.php?opcion=0&idProd=" + idProducto + "&cantidad=" + cant, true);
    comm.send(null);
    comm.onreadystatechange = function () {
        if (comm.readyState == 4 && comm.status == 200) {
            console.log(comm.responseText);
            switch (comm.responseText) {
                case "-1":
                    document.getElementById("info").innerHTML = "Error de conexión...";
                    break;
                case "0":
                    break;
                case "ok":
                    alert("Agregado correctamente al carrito!");
                    window.location.href = "tienda.html";
                    break;
                case "2":
                    document.getElementById('info').innerHTML = "No puedes agregar al carrito si no has iniciado sesion...";
                    break;
                default:
                    break;
            }//fin del switch
        }//fin del if de obtencion de resultados
    }//fin del onreadystatechange
}//fin de agregar al carrito

function listarOrdenes() {
    var comm = new XMLHttpRequest();
    comm.open("GET", "./modelo/manejoOrdenesProductos.php?opcion=1", true);
    comm.send(null);
    comm.onreadystatechange = function () {
        if (comm.readyState == 4 && comm.status == 200) {
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

function agregarElementoListaOrdenes(listaOrdenJSON) {
    creaTablaSuperiorListaOrdenes();
    var tablaLista = document.getElementById('tablaOrden');
    for (var indice in listaOrdenJSON) {

        var tr = document.createElement('TR');
        var tdID = document.createElement('TD');
        tdID.appendChild(document.createTextNode(listaOrdenJSON[indice].ID_ORDEN));
        var tdTotal = document.createElement('TD');
        tdTotal.appendChild(document.createTextNode(listaOrdenJSON[indice].TOTAL));

        var tdBoton = document.createElement('BUTTON');
        tdBoton.setAttribute("value", listaOrdenJSON[indice].ID_ORDEN);
        tdBoton.setAttribute("type", "button");
        tdBoton.setAttribute("class", "botonTabla");
        var funcionAlCLick = "detalleOrden(" + listaOrdenJSON[indice].ID_ORDEN + ")";
        tdBoton.setAttribute("onclick", funcionAlCLick);
        tdBoton.appendChild(document.createTextNode("Visualizar"));

        tr.appendChild(tdID);
        tr.appendChild(tdTotal);
        tr.appendChild(tdBoton);
        tablaLista.appendChild(tr);
    }//fin del for


}//fin de agregar elemento

function creaTablaSuperiorListaOrdenes() {
    var campoTabla = document.getElementById('campoTabla');
    var tabla = document.createElement('TABLE');
    tabla.setAttribute("class", "ta");
    tabla.setAttribute("class", "mt-5");
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
    tbody.setAttribute('id', 'tablaOrden');
    tbody.setAttribute('class', 'ta');

    tabla.appendChild(tbody);

    campoTabla.appendChild(tabla);
}//fin de la creacion de la parte superior de la tabla de la lista de las ordenes

function detalleOrden(idOrden) {
    var comm = new XMLHttpRequest();
    comm.open("GET", "./modelo/manejoOrdenesProductos.php?opcion=2&idOrden=" + idOrden, true);
    comm.send(null);
    comm.onreadystatechange = function () {
        if (comm.readyState == 4 && comm.status == 200) {
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

function agregarElementoListaDetalle(listaDetalleJSON) {
    creaTablaSuperiorListaDetalle();
    var tablaLista = document.getElementById('tablaDetalle');
    for (var indice in listaDetalleJSON) {
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

function creaTablaSuperiorListaDetalle() {
    var campoTabla = document.getElementById('detalle');
    var tabla = document.createElement('TABLE');
    tabla.setAttribute("class", "ta");
    tabla.setAttribute("class", "mt-5");
    var thead = document.createElement('THEAD');
    var trHead = document.createElement('TR');

    var thNomb = document.createElement('TH');
    thNomb.appendChild(document.createTextNode("Nombre"));
    var thUnid = document.createElement('TH');
    thUnid.appendChild(document.createTextNode("Unit"));
    var thCant = document.createElement('TH');
    thCant.appendChild(document.createTextNode("Cant"));
    var thTotal = document.createElement('TH');
    thTotal.appendChild(document.createTextNode("Total"));

    trHead.appendChild(thNomb);
    trHead.appendChild(thUnid);
    trHead.appendChild(thCant);
    trHead.appendChild(thTotal);
    thead.appendChild(trHead);
    tabla.appendChild(thead);

    var tbody = document.createElement('tbody');
    tbody.setAttribute('id', 'tablaDetalle');
    tbody.setAttribute('class', 'ta');

    tabla.appendChild(tbody);

    campoTabla.appendChild(tabla);
}//fin de la creacion de la parte superior de la tabla de la lista de las ordenes

function listarProductos() {
    var comm = new XMLHttpRequest();
    comm.open("GET", "./modelo/manejoOrdenesProductos.php?opcion=3", true);
    comm.send(null);
    comm.onreadystatechange = function () {
        if (comm.readyState == 4 && comm.status == 200) {
            switch (comm.responseText) {
                case "-1":
                    console.log("Error -1");
                    break;
                case "0":
                    console.log("Error 0");
                    break;
                default:
                    let datos = JSON.parse(comm.responseText);
                    creaElementosDeProductos(datos);
                    break;
            }//fin del switch
        }//fin del if de obtencion de resultados
    }//fin del onreadystatechange
}//fin de lista productos en la tienda

function creaElementosDeProductos(datos) {
    let divResp = document.getElementById("respuesta");
    divResp.innerHTML = "";
    for (let i = 0; i < datos.length; i++) {
        let nombre = datos[i].nombre;
        let id = datos[i].idProducto;
        let desc = datos[i].descripccion;
        let precio = datos[i].precio;
        let imagen = datos[i].imageName;
        let stock = datos[i].cantVenta;
        let divArticulo = document.createElement("div");
        divArticulo.classList.add("articulo");
        let divBoton = document.createElement("div");
        divBoton.classList.add('botones');
        let divImg = document.createElement('div');
        divImg.classList.add('imagen')
        let divTitulo = document.createElement('div');
        divTitulo.classList.add('titulo');
        let divPrecio = document.createElement('div');
        divPrecio.classList.add('precio');
        let divDesc = document.createElement('div');
        divDesc.classList.add('precio');
        //formato para los botones
        let inputCant = document.createElement('input');
        inputCant.setAttribute('type', 'number');
        inputCant.setAttribute('min', '1');
        inputCant.setAttribute('max', stock);
        inputCant.setAttribute('value', '1');
        inputCant.setAttribute('id', 'cant' + id);
        inputCant.classList.add('precio');

        divArticulo.appendChild(divImg);
        divArticulo.appendChild(divTitulo);
        divArticulo.appendChild(divPrecio);
        divArticulo.appendChild(divDesc);
        divArticulo.appendChild(inputCant);
        divArticulo.appendChild(divBoton);
        divResp.appendChild(divArticulo);

        let img = document.createElement("img");
        img.setAttribute("src", "imagenesProductos/" + imagen);
        divImg.appendChild(img);

        let h3Titulo = document.createElement("h3");
        h3Titulo.innerText = nombre;
        divTitulo.appendChild(h3Titulo);

        let pPrecio = document.createElement("p")
        pPrecio.innerText = "‎₡" + precio;
        divPrecio.appendChild(pPrecio);

        let pDesc = document.createElement("p")
        pDesc.innerText = desc + " (" + stock + " unidades disponibles)";
        divDesc.appendChild(pDesc);

        let verProd = document.createElement("a")
        verProd.innerText = "Agregar al carrito";
        verProd.setAttribute('onclick', "agregarAlCarrito(" + id + ")");
        divBoton.appendChild(verProd);
    }//fin del for
}//fin de la creacion de los elementos de los productos

function listarProductosCarrito() {
    var comm = new XMLHttpRequest();
    comm.open("GET", "./modelo/manejoOrdenesProductos.php?opcion=4", true);
    comm.send(null);
    comm.onreadystatechange = function () {
        if (comm.readyState == 4 && comm.status == 200) {
            switch (comm.responseText) {
                case "-1":
                    document.getElementById('infoCarrito').innerHTML = "Error de red";
                    break;
                case "0":
                    document.getElementById('infoCarrito').innerHTML = "El carrito está vacío...";
                    break;
                default:
                    var listaCarritoJSON = JSON.parse(comm.responseText);
                    agregarElementoListaCarrito(listaCarritoJSON);
                    break;
            }//fin del switch
        }//fin del if de obtencion de resultados
    }//fin del onreadystatechange
}//fin de lista de carrito

function agregarElementoListaCarrito(listaOrdenJSON) {
    creaTablaSuperiorListaCarrito();
    var tablaLista = document.getElementById('tablaOrden');
    for (var indice in listaOrdenJSON) {

        var tr = document.createElement('TR');
        var tdNombre = document.createElement('TD');
        tdNombre.appendChild(document.createTextNode(listaOrdenJSON[indice].nombre));
        var tdPrecio = document.createElement('TD');
        tdPrecio.appendChild(document.createTextNode(listaOrdenJSON[indice].precio));
        var tdCant = document.createElement('TD');
        tdCant.appendChild(document.createTextNode(listaOrdenJSON[indice].CANTIDAD));
        var tdTotal = document.createElement('TD');
        tdTotal.appendChild(document.createTextNode(listaOrdenJSON[indice].TOTAL));


        tr.appendChild(tdNombre);
        tr.appendChild(tdPrecio);
        tr.appendChild(tdCant);
        tr.appendChild(tdTotal);
        tablaLista.appendChild(tr);
    }//fin del for
}//fin de agregar elemento

function creaTablaSuperiorListaCarrito() {
    var campoTabla = document.getElementById('campoTablaCarrito');
    var tabla = document.createElement('TABLE');
    tabla.setAttribute("class", "ta");
    tabla.setAttribute("class", "mt-5");
    tabla.setAttribute("class", "m-auto");
    var thead = document.createElement('THEAD');
    var trHead = document.createElement('TR');

    var thNombre = document.createElement('TH');
    thNombre.appendChild(document.createTextNode("Nombre del producto"));
    var thPrecio = document.createElement('TH');
    thPrecio.appendChild(document.createTextNode("Precio unid"));
    var thCant = document.createElement('TH');
    thCant.appendChild(document.createTextNode("Cantidad"));
    var thTotal = document.createElement('TH');
    thTotal.appendChild(document.createTextNode("Total"));

    trHead.appendChild(thNombre);
    trHead.appendChild(thPrecio);
    trHead.appendChild(thCant);
    trHead.appendChild(thTotal);
    thead.appendChild(trHead);
    tabla.appendChild(thead);

    var tbody = document.createElement('tbody');
    tbody.setAttribute('id', 'tablaOrden');
    tbody.setAttribute('class', 'ta');

    tabla.appendChild(tbody);

    campoTabla.appendChild(tabla);

    creaElementosDelCarrito();
}//fin de la creacion de la parte superior de la tabla de la lista de las ordenes

function creaElementosDelCarrito() {
    //Este metodo crea los elementos de input de la direccion de donde te llevamos el pedido
    //y el boton de confirmar la compra, es llamado si hay productos 
    //en el carrito desde creaTablaSuperiorListaCarrito();
    var campoInputBoton = document.getElementById('campoInpBtn');

    var label = document.createElement('label');
    label.appendChild(document.createTextNode("Dinos a donde te llevamos el pedido:"));

    var campoText = document.createElement('input');
    campoText.setAttribute('type', 'text');
    campoText.setAttribute('name', 'direccion');
    campoText.setAttribute('id', 'direccion');

    var boton = document.createElement('input');
    boton.setAttribute('type', 'button');
    boton.setAttribute('class', 'botones');
    boton.setAttribute('value', 'Confirmar compra');
    boton.setAttribute('onclick', 'confirmaCompra()');

    campoInputBoton.appendChild(label);
    campoInputBoton.appendChild(campoText);
    campoInputBoton.appendChild(boton);
}//fin de la creacion de los elementos del carrito

function confirmaCompra() {
    var direccion = document.getElementById('direccion').value;
    var comm = new XMLHttpRequest();
    comm.open("GET", "./modelo/manejoOrdenesProductos.php?opcion=5&direccion=" + direccion, true);
    comm.send(null);
    comm.onreadystatechange = function () {
        if (comm.readyState == 4 && comm.status == 200) {
            console.log(comm.responseText);
            switch (comm.responseText) {
                case "-1":
                    console.log("Error -1");
                    break;
                case "0":
                    console.log("Error 0");
                    break;
                case "1":
                    alert("Compra realizada con exito!");
                    window.location.href = "tusOrdenes.html";
                    break;
                default:

                    break;
            }//fin del switch
        }//fin del if de obtencion de resultados
    }//fin del onreadystatechange
}//fin de la confirmacion de la compra

function botonBuscarProductos() {
    let nombreProducto = document.getElementById("nombre").value;
    let divResp = document.getElementById("respuesta");
    divResp.innerHTML = "";
    let ajax = new XMLHttpRequest();
    let method = "GET";
    let url = "./modelo/manejoOrdenesProductos.php?opcion=6&nombre=" + nombreProducto;
    let async = true;
    ajax.open(method, url, async);
    ajax.send();
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4 && ajax.status === 200) {
            let datos = JSON.parse(ajax.responseText);
            agregaElementosBusqueda(datos);
        }//fin del if del readystate
    };
}//fin del metodo que busca productos 

function agregaElementosBusqueda(datos) {
    let divResp = document.getElementById("respuesta");
    for (let i = 0; i < datos.length; i++) {
        let nombre = datos[i].nombre;
        let id = datos[i].idProducto;
        let desc = datos[i].descripccion;
        let precio = datos[i].precio;
        let imagen = datos[i].imageName;
        let stock = datos[i].cantVenta;

        let divArticulo = document.createElement("div");
        divArticulo.classList.add("articulo");
        let divBoton = document.createElement("div");
        divBoton.classList.add('botones');
        let divImg = document.createElement('div')
        divImg.classList.add('imagen')
        let divTitulo = document.createElement('div')
        divTitulo.classList.add('titulo');
        let divPrecio = document.createElement('div')
        divPrecio.classList.add('precio');
        let divDesc = document.createElement('div')
        divDesc.classList.add('precio');

        divArticulo.appendChild(divImg);
        divArticulo.appendChild(divTitulo);
        divArticulo.appendChild(divPrecio);
        divArticulo.appendChild(divDesc);
        divArticulo.appendChild(divBoton);
        divResp.appendChild(divArticulo);

        let img = document.createElement("img");
        img.setAttribute("src", "imagenesProductos/" + imagen);
        divImg.appendChild(img);
        let h3Titulo = document.createElement("h3")
        h3Titulo.innerText = nombre;
        divTitulo.appendChild(h3Titulo);
        let pPrecio = document.createElement("p")
        pPrecio.innerText = "‎₡" + precio;
        divPrecio.appendChild(pPrecio);
        let pDesc = document.createElement("p")
        pDesc.innerText = desc + " (" + stock + " unidades disponibles)";
        divDesc.appendChild(pDesc);
        let verProd = document.createElement("a")
        verProd.innerText = "Agregar al carrito";
        verProd.setAttribute('onclick', "agregarAlCarrito(" + id + ")");
        divBoton.appendChild(verProd);
    }//fin del for
}//fin del metodo que agrega los elementos de la busqueda





