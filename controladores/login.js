'use strict'

function login(){
    var nickname = document.getElementById("username").value;
    var pass = document.getElementById("password").value;
    if(nickname.length > 0 && pass.length > 0){
        var comm = new XMLHttpRequest();
        comm.open("GET","./modelo/login.php?opcion=1&username="+nickname+"&password="+pass,true);
        comm.send(null);
        comm.onreadystatechange = function(){
            if(comm.readyState == 4 && comm.status == 200){
                console.log(comm.responseText);
                switch (comm.responseText) {
                    case "-1":
                        document.getElementById("h5InfoLog").innerHTML = "Error de conexión..."; 
                        break;
                    case "0":
                        document.getElementById("h5InfoLog").innerHTML = "Datos incorrectos..."; 
                        break;     
                    case "1":
                        window.location.href = "index.php";
                        break;                                     
                    default:
                        break;
                }
            }//fin del if de obtencion de resultados
        }//fin del onreadystatechange
    }
    else{
        document.getElementById("h5InfoLog").innerHTML = "Llene los dos campos..."; 
    }
    
}