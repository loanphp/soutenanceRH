import { FetchRequest } from "../fetch_request.js";
import { ResolvePath } from "./resolver.js";

function detailEvaluation(){
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');
    let formdata = new FormData();
    formdata.append("id", id);
    new FetchRequest(ResolvePath("request/get/response/evaluation"), formdata, null, function(response){
        console.log(response.data);
    })
}
function imprimer(){
    document.getElementById('printButton').addEventListener('click', function() {
        // Masquez le bouton d'impression pour qu'il n'apparaisse pas dans l'impression
        this.style.display = 'none';
  
        // Appelez la fonction d'impression
        window.print();
  
        // Réaffiche le bouton d'impression après l'impression (peut prendre un certain temps)
        setTimeout(function() {
          document.getElementById('printButton').style.display = 'block';
        }, 1000);
      });
}
imprimer();
detailEvaluation();
