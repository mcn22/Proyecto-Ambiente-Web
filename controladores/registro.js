'use strict'

function registrar(){
    var nombre = document.getElementById("nombre").value;
    var nickname = document.getElementById("nickname").value;
    var pass = document.getElementById("pass").value;
    if(validarNombre(nombre) && validarNick(nickname) && validarPass(pass)){
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

}