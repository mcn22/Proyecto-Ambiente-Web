document.getElementById("boton-buscar").addEventListener("click", () => {
  let nombreProducto = document.getElementById("nombre").value;
  let divResp = document.getElementById("respuesta");
  divResp.innerHTML = "";

  let ajax = new XMLHttpRequest();
  let method = "GET";
  let url = "modelo/buscar.php?nombre=" + nombreProducto;
  let async = true;

  ajax.open(method, url, async);

  ajax.send();

  ajax.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      let datos = JSON.parse(this.responseText);
      console.log(datos);

      for (let i = 0; i < datos.length; i++) {
        let nombre = datos[i].nombre;
        let id = datos[i].idProducto;
        let desc = datos[i].descripccion;
        let precio = datos[i].precio;
        let imagen = datos[i].imageName;

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
        pPrecio.innerText = precio;
        divPrecio.appendChild(pPrecio);

        let pDesc =document.createElement("p")
        pDesc.innerText = desc;
        divDesc.appendChild(pDesc);

        let verProd = document.createElement("a")
        verProd.innerText = "VER PRODUCTO";
        verProd.setAttribute('href',"producto.php?id=" + id);
        divBoton.appendChild(verProd);
      }
    }
  };
});
