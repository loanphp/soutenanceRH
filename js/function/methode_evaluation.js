import { FetchRequest } from "../fetch_request.js";
import { ResolvePath } from "./resolver.js";
import { Popup } from "../module/alert.js";
function creatTache(){
    let button = document.querySelector("#aFaire");
    let formModale = document.querySelector(".modale_form")
    let form = document.querySelector(".form_modale_form");
    autoOpen(formModale, button, {dispatch:true});
    form.addEventListener("submit",function(e){
        e.preventDefault(e);
        let formdata = new FormData(form);
        formdata.append("formtype", "create");
        new FetchRequest(ResolvePath("request/taches"), formdata, null, function(response){
            if(true === response.success){
                let template = frameHtml(response.data);
                let todo_containers = document.querySelector(".todo_container");
                todo_containers.insertBefore(template,  formModale.nextElementSibling);
                formModale.style.display = "none";
                return handleRequestMessage({title:'Succès !',message:response.message,type:'success'});
            }
            if(false === response.success){
                return handleRequestMessage({title:'Erreur !',message:response.message,type:'danger'});
            }
        })

    })
}
function frameHtml(data){
    let frame = `       <div class="tache_frame">
    <div class="field_container tache_name_frame">
        <div class="tache_name_child">
            <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
            <h6>${data.tache_a_effectuee}</h6>
        </div>
        <div class="select_tache">
            <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
            <select name="" id="">
                <option value="todo">A faire</option>
                <option value="pending">En cours</option>
                <option value="end">Terminé</option>
                <option value="cancel">Annulé</option>
            </select>
        </div>
    </div>
    <div class="field_container date_frame">
        <div class="date_frame_container">
            <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
            <small>${data.date_de_fin}</small>
        </div>
        <img src="${data.photo}" class="img_employee" alt="">
    </div>
</div>`;
let div = document.createElement('div');
div.innerHTML = frame;
return div.firstElementChild;
}
function searchEmploye(){
    let search = document.querySelector("#nom_employe");
    let employe_container = document.querySelector(".employe_container");
    let success = false;
    let employes = null
    autoOpen(employe_container, search, {dispatch:true});
    search.addEventListener("input", async function(){
        let value = search.value.toLowerCase();
        if(success==false){
            employes = await getAllEmploye();
            success = true;
        }
        if(employes!==null){
            for (const key in employes) {
                if (Object.hasOwnProperty.call(employes, key)){
                    const employe = employes[key];
                    let fullname = employe["nom_employe"] + " " + employe["prenom_employe"];
                    let matching = value.match(fullname.toLowerCase());
                    // console.log({fullname,matching, value});
                    if(matching){
                        let templates = employeHtml(employe);
                        let existingtemplate = document.querySelector(`div[data-id="${templates.id}"]`)
                        if(!existingtemplate){
                            let element = templates.element;
                            element.addEventListener('click',setEmployeTache)
                            employe_container.appendChild(element);
                        }
                        
                    }
                }
            }
        }
    })
}
function setEmployeTache(){
    let id = this.dataset.id;
    let form = document.querySelector(".form_modale_form");
    let hiddeninput = form.querySelector("input[type='hidden']");
    let employe_container = document.querySelector(".employe_container");
    if(hiddeninput){
        hiddeninput.value = id;
        employe_container.style.display = "none";
    }
}
function autoOpen(element, button,dispatcher){
    button.addEventListener("click", function(){
        element.style.display = "flex";
    });
    if( dispatcher.dispatch===true){
        document.addEventListener("click", function(e){
            let dispatchelement = dispatcher.dispatchelement ?? element;
            let target = e.target;
            if(!button.contains(target) && !dispatchelement.contains(target)){
                dispatchelement.style.display = "none";
            }
        });
    }

   
}
function employeHtml(data){
    let template = `<div data-id="${data.id}" class="employe_parent"><img src="${data.photo}" alt=""><span><h6>${data.nom_employe} ${data.prenom_employe}</h6></span></div>`
    let div = document.createElement("div");
    div.innerHTML = template;
    return {element:div.firstElementChild, id:data.id};
}
async function getAllEmploye(){
    let formdata = new FormData();
    let data = null;
    formdata.append("id",-1);
    formdata.append("formtype", "getAll");
    const request = await fetch(ResolvePath("request/get/employe"),{
        method: "POST",
        body: formdata
    });
    const response = await request.json();
    if(response.success){
        data = response.data;
    }
    return data;
}
function handleRequestMessage(data={title,message,type}){
    const modal = new Popup();
    const flash_modal = document.querySelector("flash-modal");
    if(flash_modal){flash_modal.remove()}
    modal.display({title:data.title, type:data.type, message:data.message})
    modal.handleAudio(5000, {set:true, path:'public/popupsing.wav', volume:0.7});
}
searchEmploye();
creatTache()    