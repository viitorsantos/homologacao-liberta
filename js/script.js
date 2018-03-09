function ajax(url) {
     req = null;

     if (window.XMLHttpRequest) {
         req = new XMLHttpRequest();
         req.onreadystatechange = processReqChange;
         req.open("GET", url, true);
         req.send(null);
     }
     else if (window.ActiveXObject) {
         req = new ActiveXObject("Microsoft.XMLHTTP");

         if (req) {
             req.onreadystatechange = processReqChange;
             req.open("GET", url, true);
             req.send();
         }
     }
}

function processReqChange() {
     /*
     1 = a carregar.
     2 = carregado.
     3 = interactivo.
     4 = completo.
     apenas quando o estado for "completado"
     */
     if (req.readyState == 4) {
         /*
         200 = OK
         404 = página não encontrada.
         500 = Erro interno do servidor.
         apenas se o servidor retornar "OK"
         */
         if (req.status == 200) {
             document.getElementById('funcionario_2').innerHTML = req.responseText;
         }
         else {
             alert("Houve um problema ao obter os dados: " + req.statusText);
         }
     }
}


