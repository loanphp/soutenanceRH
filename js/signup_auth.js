import { FetchRequest } from "./fetch_request.js";
import { ResolvePath } from "./function/resolver.js";
import { Popup } from "./module/alert.js";
let form = document.querySelector('form');
form.addEventListener('submit', function(e){
    e.preventDefault();
    let formdata = new FormData(form);
    let fetchRequest = new FetchRequest(ResolvePath("request/inscription"), formdata, "/connection", function(response){
        if(true === response.success){
            return handleRequestMessage({title:'Succès !',message:response.message,type:'success'});
        }
        if(false === response.success){
            return handleRequestMessage({title:'Erreur !',message:response.message,type:'danger'});
        }
    });
});

function handleRequestMessage(data={title,message,type}){
    const modal = new Popup();
    modal.display({title:data.title, type:data.type, message:data.message})
    modal.handleAudio(5000, {set:true, path:'public/popupsing.wav', volume:0.7});
}