'use strict'

function validarNombre(nombre){
    var ok = false;
    if (nombre.length > 0 && nombre.length < 20) {
        var regex = /^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/g;
        if(regex.exec(nombre)){
            ok = true;
        }
        else{
            document.getElementById("h5Info").innerHTML = "Error de formato en el nombre...";
        }
    }
    else{
        document.getElementById("h5Info").innerHTML = "Error de tamaño en el nombre...";
    }
    return ok;
}//fin de la funcion de la validacion del nombre

function validarNick(nick){
    var ok = false;
    if (nick.length > 0 && nick.length < 20) {
        var regex = /^[0-9a-zA-Z]+$/;  
        if(regex.exec(nick)){
                ok = true;          
        }
        else{
            document.getElementById("h5Info").innerHTML = "Error de formato en el nickname...";
        }
    }
    else{
        document.getElementById("h5Info").innerHTML = "Error de tamaño en el nickname...";
    }
    return ok;
}//fin de la funcion de la validacion del nick

function validarPass(pass){
    var ok = false;
    if (pass.length > 0 && pass.length < 60) {
        ok = true;
    }
    else{
        document.getElementById("h5Info").innerHTML = "Error de tamaño en el el password...";
    }
    return ok;
}//fin de la funcion de la validacion del pass