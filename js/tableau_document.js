import { FetchRequest } from "./fetch_request.js";
import { ResolvePath } from "./function/resolver.js";
import { Popup } from "./module/alert.js";
function deleteFile(){
    let closes = document.querySelectorAll(".remove");
    closes.forEach(close => {
        close.addEventListener("click",function(){
            let numero_securite_sociale = close.dataset.numero;
            let id= close.dataset.id;
            let colonne = close.dataset.colonne;
            let formdata = new FormData();
            formdata.append("numero_securite_sociale", numero_securite_sociale);
            formdata.append("formtype", "delete");
            formdata.append("colonne", colonne);
            let resultat = confirm("Voulez-vous vraiment supprimer fichier ?");
            if(resultat==true){
                new FetchRequest(ResolvePath("request/get/documents/employe"), formdata, null, function(response){
                    if(true === response.success){
                        
                        let td = document.querySelector(`td[data-td-id="${id}"]`);
                        let button = close.closest(".buttons");
                        console.log(td, button);
                        if(td && button){
                            button.remove();
                            td.style.color = "red";
                            td.innerHTML = "Aucun fichier disponible!"
                        }
                    }
                    if(false === response.success){
                        return handleRequestMessage({title:'Erreur !',message:response.message,type:'danger'});
                    }
                })
            }
        });
       
        
    });
}
deleteFile();
function handleRequestMessage(data={title,message,type}){
    const modal = new Popup();
    modal.display({title:data.title, type:data.type, message:data.message})
    modal.handleAudio(5000, {set:true, path:'public/popupsing.wav', volume:0.7});
}