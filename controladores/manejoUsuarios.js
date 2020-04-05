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
                        document.getElementById("h5Info").innerHTML = "Registrado con éxito, vaya al login...";
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
                        window.location.href = "./infoUsuario.php";
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
                        window.location.href = "./infoUsuario.php";
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
                        window.location.href = "./infoUsuario.php";
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
                    window.location.href = "./index.php";
                    break;                                   
                default:
                    break;
            }
        }//fin del if de obtencion de resultados
    }//fin del onreadystatechange
}//fin del cambio del pass

