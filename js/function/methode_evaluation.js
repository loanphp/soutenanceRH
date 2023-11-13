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
function frameHtml(data, appreciation=false){
    let appreciationhtml = appreciation?`<div class="appreciation_container">
                                            <input type="text" placeholder="appréciation en pourcentage" value=" ${data["appreciation"]?data["appreciation"]:"" }" name="appreciation" placeholder="appréciation en pourcentage" class="appreciation_input">
                                            <button type="button" data-id="${data["id"]}" class="appreciation_button"><svg>
                                            <use xlink:href="../../public/svg/alert.svg#send"></use>
                                                </svg></button>
                                        </div>`: "";
    let frame = `       <div class="tache_frame" data-employe-id = "${data["employe_id"]}">
    <div class="field_container tache_name_frame">
        <div class="tache_name_child">
            <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
            <h6>${data.tache_a_effectuee}</h6>
        </div>
        <div class="select_tache select_tache_appreciation">
            <div class="status_container">
                <span><svg><use xlink:href="../../public/svg/alert.svg#add"></use></svg></span>
                <select id="" data-id = "${data.id}" class="select_status" name="status">
                    <option value="todo">A faire</option>
                    <option value="pending">En cours</option>
                    <option value="end">Terminé</option>
                    <option value="cancel">Annulé</option>
                
                </select>
            </div>
            ${appreciationhtml}
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
function repushChangeEvent(element){
    let select = element.querySelector("select");
    pushChangeEvent(select);
}
function pushChangeEvent(element){
    element.addEventListener("change",function(){
        let id = element.dataset.id;
        let lasttacheframe = element.closest(".tache_frame");
        let employe_id = lasttacheframe.dataset.employeId;
        let formdata = new FormData();
        formdata.append("employe_id",employe_id);
        formdata.append("status",element.value);
        formdata.append("id",id);
        formdata.append("formtype", "change_status");
        formdata.append("date_de_fin","-1");
        formdata.append("tache_a_effectuee", "-1");
        new FetchRequest(ResolvePath("request/taches"), formdata,null,function(response){
            if(true === response.success){
                let data = response.data;
                let status = data.status;
                let newtacheframe =  document.querySelector(`td[data-status="${status}"]`);
                lasttacheframe.remove();
                let template = frameHtml(data);
                if(data.status=="end" || data.status=="cancel"){
                    template = frameHtml(data, true);
                    repushAppreciationEvent(template);

                }
                repushChangeEvent(template);
                template.addEventListener('change', changeStatus);
                newtacheframe.insertBefore(template, newtacheframe.firstElementChild);
                return handleRequestMessage({title:'Succès !',message:response.message,type:'success'});
            }
            if(false === response.success){
                return handleRequestMessage({title:'Erreur !',message:response.message,type:'danger'});
            }
        })
    });
};
function changeStatus(){
    let selectStatus = document.querySelectorAll(".select_status");
    if(selectStatus){
        selectStatus.forEach(element => {
            pushChangeEvent(element);
                      
        });
    }
}
function pushAppreciationEvent(element){
    element.addEventListener("click",function(e) {
        let id = element.dataset.id;
        let input = element.previousElementSibling;
        let appreciation = input.value;
        let formdata = new FormData();
        formdata.append("id",id);
        formdata.append("employe_id", "-1");
        formdata.append("appreciation",appreciation);
        formdata.append("formtype", "addappreciation" );
        formdata.append("date_de_fin","-1");
        formdata.append("tache_a_effectuee", "-1");
        new FetchRequest(ResolvePath("request/taches"), formdata, null, function(response){
            if(true === response.success){
                return handleRequestMessage({title:'Succès !',message:response.message,type:'success'});
            }
            if(false === response.success){
                return handleRequestMessage({title:'Erreur !',message:response.message,type:'danger'});
            }
        })
    });
}
function addAppreciation(){
    let appreciation_buttons =document.querySelectorAll(".appreciation_button");
    appreciation_buttons.forEach(element => {
        pushAppreciationEvent(element);     
    });
}
function repushAppreciationEvent(element){
    let button = element.querySelector("button");
    pushAppreciationEvent(button);
}
function handleRequestMessage(data={title,message,type}){
    const modal = new Popup();
    const flash_modal = document.querySelector("flash-modal");
    if(flash_modal){flash_modal.remove()}
    modal.display({title:data.title, type:data.type, message:data.message})
    modal.handleAudio(5000, {set:true, path:'public/popupsing.wav', volume:0.7});
}
addAppreciation()
changeStatus();
searchEmploye();
creatTache();  