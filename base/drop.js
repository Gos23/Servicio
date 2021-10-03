function habilita_drag(objeto, tipo) {
   objeto.draggable = true;
   objeto.setAttribute("data-droptype", tipo);
   objeto.ondragstart = function(evento) {
      evento.dataTransfer.setData("text/plain", evento.target.id);
      evento.dataTransfer.dropEffect = "move";
   };
}

function habilita_drop(objeto, tipo, funcion) {     
   objeto.ondragover = (evento) => evento.preventDefault( );
   objeto.addEventListener("drop", function(evento) {
      let adoptar = document.getElementById(evento.dataTransfer.getData("text/plain"));
      if (adoptar.getAttribute("data-droptype") == tipo) {
         funcion(adoptar);
      }
   });
}

function habilita_drop_hermano(objeto, tipo, hermano, notifica_drop) {
   habilita_drop(objeto, tipo, function(adoptar) {
      hermano.parentNode.insertBefore(adoptar, hermano);
      if (notifica_drop != undefined) {
         notifica_drop(hermano, adoptar);
      }
   });
}

function habilita_drop_hijo(objeto, tipo, padre, notifica_drop) {
   habilita_drop(objeto, tipo, function(adoptar) {
      padre.appendChild(adoptar);
      if (notifica_drop != undefined) {
         notifica_drop(padre, adoptar);
      }
   });
}
