'use strict'

function registrar(){
    var nombre = document.getElementById("nombre").value;
    var nickname = document.getElementById("nickname").value;
    var pass = document.getElementById("pass").value;
    if(validarNombre(nombre, 1) && validarNick(nickname, 1) && validarPass(pass, 1)){
        var comm = new XMLHttpRequest();
        comm.open("GET","./modelo/registro.php?opcion=1&nombre="+nombre+"&nickname="+nickname+"&pass="+pass,true);
        comm.send(null);
        comm.onreadystatechange = function(){
            if(comm.readyState == 4 && comm.status == 200){
                switch (comm.responseText) {
                    case "-1":
                        document.getElementById("h5Info").innerHTML = "Error de conexión...";
                        break;
                    case "0":
                        document.getElementById("h5Info").innerHTML = "El nickname ya está en uso...";
                        break;     
                    case "1":
                        window.location.href = "login.html";
                        document.getElementById("h5Info").innerHTML = "Registrado con éxito, inicia sesion...";
                        break;                                     
                    default:
                        break;
                }
            }//fin del if de obtencion de resultados
        }//fin del onreadystatechange
    }//fin del if de las validaciones
}//fin de la registracion del usuario

function cambioNombre(){
    var nombre = document.getElementById("nuevoNombre").value;
    if(validarNombre(nombre, 0)){
        var comm = new XMLHttpRequest();
        comm.open("GET","./modelo/registro.php?opcion=2&cambioNombre="+nombre,true);
        comm.send(null);
        comm.onreadystatechange = function(){
            if(comm.readyState == 4 && comm.status == 200){
                switch (comm.responseText) {
                    case "-1":
                        document.getElementById("h5InfoCambio").innerHTML = "Error de conexión...";
                        break;
                    case "0":
                        document.getElementById("h5InfoCambio").innerHTML = "Hubo un error...";
                        break;     
                    case "1":
                        window.location.href = "./infoUsuario.html";
                        document.getElementById("h5InfoCambio").innerHTML = "Cambio correcto...";
                        break;                                     
                    default:
                        break;
                }
            }//fin del if de obtencion de resultados
        }//fin del onreadystatechange
    }//fin del if de las validaciones
    else{
        document.getElementById("h5InfoCambio").innerHTML = "Revisa el formato del nombre...";
    }
}//fin del cambio de nombre

function cambioNick(){
    var nick = document.getElementById("nuevoNick").value;
    if(validarNick(nick, 0)){
        var comm = new XMLHttpRequest();
        comm.open("GET","./modelo/registro.php?opcion=3&cambioNick="+nick,true);
        comm.send(null);
        comm.onreadystatechange = function(){
            if(comm.readyState == 4 && comm.status == 200){
                switch (comm.responseText) {
                    case "-1":
                        document.getElementById("h5InfoCambio").innerHTML = "Error de conexión...";w
                        break;
                    case "0":
                        document.getElementById("h5InfoCambio").innerHTML = "Ese nickname esta en uso...";
                        break;     
                    case "1":
                        window.location.href = "./infoUsuario.html";
                        document.getElementById("h5InfoCambio").innerHTML = "Cambio correcto...";
                        break;                                     
                    default:
                        break;
                }
            }//fin del if de obtencion de resultados
        }//fin del onreadystatechange
    }//fin del if de las validaciones
    else{
        document.getElementById("h5InfoCambio").innerHTML = "Revisa el formato del nickname...";
    }
}//fin del cambio de nickname

function cambioPass(){
    var viejoPass = document.getElementById("viejoPass").value;
    var nuevoPass = document.getElementById("nuevoPass").value;
    if(validarPass(viejoPass, 0) && validarPass(nuevoPass, 0)){
        var comm = new XMLHttpRequest();
        comm.open("GET","./modelo/registro.php?opcion=4&viejoPass="+viejoPass+"&nuevoPass="+nuevoPass,true);
        comm.send(null);
        comm.onreadystatechange = function(){
            if(comm.readyState == 4 && comm.status == 200){
                switch (comm.responseText) {
                    case "-1":
                        document.getElementById("h5InfoCambio").innerHTML = "Error de conexión...";
                        break;
                    case "0":
                        document.getElementById("h5InfoCambio").innerHTML = "Hubo un error...";
                        break;
                    case "1":                       
                        window.location.href = "./infoUsuario.html";
                        document.getElementById("h5InfoCambio").innerHTML = "Cambio correcto...";
                        break;  
                    case "2":
                        document.getElementById("h5InfoCambio").innerHTML = "La contraseña anterior no es valida...";
                        break;                                    
                    default:
                        break;
                }
            }//fin del if de obtencion de resultados
        }//fin del onreadystatechange
    }//fin del if de las validaciones
    else{
        document.getElementById("h5InfoCambio").innerHTML = "Revisa el formato de la contraseña...";
    }
}//fin del cambio del pass

function eliminaCuenta(){
    var comm = new XMLHttpRequest();
    comm.open("GET","./modelo/registro.php?opcion=5",true);
    comm.send(null);
    comm.onreadystatechange = function(){
        if(comm.readyState == 4 && comm.status == 200){
            switch (comm.responseText) {
                case "-1":
                    document.getElementById("h5InfoCambio").innerHTML = "Error de conexión...";
                    break;
                case "0":
                    document.getElementById("h5InfoCambio").innerHTML = "Hubo un error...";
                    break;
                case "1":                       
                    window.location.href = "./index.html";
                    break;                                   
                default:
                    break;
            }
        }//fin del if de obtencion de resultados
    }//fin del onreadystatechange
}//fin del cambio del pass

function revisaSesion(){
    var comm = new XMLHttpRequest();
    comm.open("GET","./modelo/registro.php?opcion=6",true);
    comm.send(null);
    comm.onreadystatechange = function(){
        if(comm.readyState == 4 && comm.status == 200){
            switch (comm.responseText) {
                case "-1":
                    document.getElementById("h5InfoCambio").innerHTML = "Error de conexión...";
                    break;
                case "0":
                    llenaDatosMenuNoSesion();
                    break;                                 
                default:
                    var datosUsuarioJSON = JSON.parse(comm.responseText);
                    if(datosUsuarioJSON.tipoUsuario == "c"){
                        llenaDatosMenuSiSesionCliente(datosUsuarioJSON.nombre_usuario);
                    }else{
                        llenaDatosMenuSiSesionAdmin(datosUsuarioJSON.nombre_usuario);
                    }                   
                    break;
            }//fin del sw
        }//fin del if de obtencion de resultados
    }//fin del onreadystatechange
}//fin de la revision de la sesion

function llenaDatosMenuSiSesionAdmin(nombre){
    //Nombre de usuario en el menu
    var menuTop = document.getElementById("menuTop");
    var liUsuario = document.createElement('li');
    var aUsuario = document.createElement('a');
    aUsuario.appendChild(document.createTextNode(nombre));
    aUsuario.setAttribute('href','usuario.html');
    liUsuario.appendChild(aUsuario);
    menuTop.appendChild(liUsuario);
    //fin del nombre de usuario en el menu
    //agregar producto en el menu
    var liAgregarProd = document.createElement('li');
    var aAgregarProd = document.createElement('a');
    aAgregarProd.appendChild(document.createTextNode("Agregar producto"));
    aAgregarProd.setAttribute('href','includes/subirProducto.php');
    liAgregarProd.appendChild(aAgregarProd);
    menuTop.appendChild(liAgregarProd);
    //fin de agregar producto en el menu
    //Cerrar sesion en el menu
    var liCerrarSesion = document.createElement('li');
    var aCerrarSesion = document.createElement('a');
    aCerrarSesion.appendChild(document.createTextNode("Cerrar sesion"));
    aCerrarSesion.setAttribute('onclick','cerrarSesion()');
    aCerrarSesion.style.cursor = "pointer";
    liCerrarSesion.appendChild(aCerrarSesion);
    menuTop.appendChild(liCerrarSesion);
    //fin de cerrar sesion en el menu
}//fin del llenado de los datos del menu superior si hay sesion activa

function llenaDatosMenuSiSesionCliente(nombre){
    //Nombre de usuario en el menu
    var menuTop = document.getElementById("menuTop");
    var liUsuario = document.createElement('li');
    var aUsuario = document.createElement('a');
    aUsuario.appendChild(document.createTextNode(nombre));
    aUsuario.setAttribute('href','usuario.html');
    liUsuario.appendChild(aUsuario);
    menuTop.appendChild(liUsuario);
    //fin del nombre de usuario en el menu
    //Carrito en el menu
    var liCarrito = document.createElement('li');
    var aCarrito = document.createElement('a');
    aCarrito.appendChild(document.createTextNode("Carrito"));
    aCarrito.setAttribute('href','carrito.html');
    liCarrito.appendChild(aCarrito);
    menuTop.appendChild(liCarrito);
    //fin del carrito en el menu
    //Cerrar sesion en el menu
    var liCerrarSesion = document.createElement('li');
    var aCerrarSesion = document.createElement('a');
    aCerrarSesion.appendChild(document.createTextNode("Cerrar sesion"));
    aCerrarSesion.setAttribute('onclick','cerrarSesion()');
    aCerrarSesion.style.cursor = "pointer";
    liCerrarSesion.appendChild(aCerrarSesion);
    menuTop.appendChild(liCerrarSesion);
    //fin de cerrar sesion en el menu
}//fin del llenado de los datos del menu superior si hay sesion activa

function llenaDatosMenuNoSesion(){
    //Texto de inicia sesion en el menu de inicio si no hay sesion
    var menuTop = document.getElementById("menuTop");
    var liUsuario = document.createElement('li');
    var aUsuario = document.createElement('a');
    aUsuario.appendChild(document.createTextNode("Inicia sesion"));
    aUsuario.setAttribute('href','login.html');
    liUsuario.appendChild(aUsuario);
    menuTop.appendChild(liUsuario);
    //fin del texto de inicia sesion en el menu del inicio
    //Texto de registrarse en el menu de inicio si no hay sesion
    var liregistro = document.createElement('li');
    var aregistro = document.createElement('a');
    aregistro.appendChild(document.createTextNode("Registrate"));
    aregistro.setAttribute('href','registro.html');
    liregistro.appendChild(aregistro);
    menuTop.appendChild(liregistro);
    //fin del texto de registrarse en el menu del inicio
}//fin del llenado de los datos del menu superior si hay sesion activa

function cargaNombreYNickname(){
    var comm = new XMLHttpRequest();
    comm.open("GET","./modelo/registro.php?opcion=8",true);
    comm.send(null);
    comm.onreadystatechange = function(){
        if(comm.readyState == 4 && comm.status == 200){
            switch (comm.responseText) {
                case "-1":
                    document.getElementById("h5InfoCambio").innerHTML = "Error de conexión...";
                    break;
                case "0":
                    llenaDatosMenuNoSesion();
                    break;                                 
                default:
                    var datosUsuarioJSON = JSON.parse(comm.responseText);
                    document.getElementById('h3Nombre').innerHTML = "Tu nombre es: " + datosUsuarioJSON.nombre_usuario;
                    document.getElementById('h3Nick').innerHTML = "Tu nickname es: " + datosUsuarioJSON.nickname_usuario;
            }//fin del sw
        }//fin del if de obtencion de resultados
    }//fin del onreadystatechange
}//fin del metodo que devuelve el nombre y el nick para infoUsuario.html

function cerrarSesion(){
    var comm = new XMLHttpRequest();
    comm.open("GET","./modelo/registro.php?opcion=9",true);
    comm.send(null);
    comm.onreadystatechange = function(){
        if(comm.readyState == 4 && comm.status == 200){
            switch (comm.responseText) {
                case "0":
                    llenaDatosMenuNoSesion();
                break;                                 
                default:
                    window.location.href = "./index.html";
            }//fin del sw
        }//fin del if de obtencion de resultados
    }//fin del onreadystatechange
}//fin de la funcion que cierra la sesion
