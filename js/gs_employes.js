import { handlePregressFormMethods } from "./function/progress-form.js";
import { progressFormStyle } from "./function/progress-form.js";
import { ImageUploader } from "./imageUpload.js";
import { FetchRequest } from "./fetch_request.js";
import { scrollBarInit } from "./function/utile.js";
import { ResolvePath } from "./function/resolver.js";
import { closeModal } from "./function/progress-form.js";
import { checkbox } from "./function/checkbox.js";
import { showEmployeAction } from "./module/employe-action.js";
import { dynamiqueEmploye } from "./function/dynamique-html.js";
import { formAutoFill } from "./function/utile.js";
import { search } from "./function/search.js";
function addEmployes(){
    let form = document.querySelector('form');
    if(form){
        form.addEventListener('submit', function(e){
            e.preventDefault();
            let formtype = form.dataset.formType;
            if(formtype === "add"){
                let formdata = new FormData(form);
                let formObject = {};
                let fetchRequest = new FetchRequest(ResolvePath("request/employes"), formdata, null, function(response){
                    fetchRequest.getResponse(response)
                    scrollBarInit(document.body);
                    formdata.forEach((value,key) => {
                        formObject[key] = value;
                    });
                    formObject["id"] = response.data["id"];
                    formObject["files"] = response.data["photo"];
                    formObject["poste_occupe"] = response.data["poste_occupe"];
                    formObject["job"] = response.data["job"]["name"];
                    formObject["numero_securite_sociale"] = response.data["numero_securite_sociale"];
                    let dynamiqueHtml = dynamiqueEmploye(formObject);
                    let tbody = document.querySelector("tbody");
                    tbody.insertBefore(dynamiqueHtml, tbody.firstElementChild);
                    form.reset();
                    let modaleparent = document.querySelector(".modal-container");
                    modaleparent.style.display = "none";
                });
            }
            if(formtype=="edite"){
                let butoncontainer = document.querySelector(".button-container");
                let id = butoncontainer.dataset.id;
                let formdata = new FormData(form);
                formdata.append("formtype", "edite");
                formdata.append("id", id)
                new FetchRequest(ResolvePath("resquest/get/employe"),formdata, null, function(response){
                    if(response.success){
                        let Modalcontainer = document.querySelector(".modal-container");
                        Modalcontainer.style.display = "none";
                        let datas = response.data;
                        let tr = document.querySelector(`tr[data-id='${datas.id}']`); 
                        let img = tr.querySelector(".photo-employe img");
                        for(const [key,value] of Object.entries(datas)) {
                            let h6 = tr.querySelector(`h6[data-texte='${key}']`); 
                            if(h6){
                                h6.innerHTML = value;
                            }
                            if(key=="photo"){
                                img.src = value;
                            }
                            
                        };
                    } 
                });
                
            }
        });

    }
}
export function editeEmploye(){
    let edite = document.querySelector("#edite-action");
    let form = document.querySelector("form");
    if(edite){
        edite.addEventListener("click", function(e){
            let butoncontainer = document.querySelector(".button-container");
            let id = butoncontainer.dataset.id;
            let formdata = new FormData();
            formdata.append("id", id);
            formdata.append("formtype","get");
            new FetchRequest(ResolvePath("resquest/get/employe"), formdata, null, function(response){
                if(response.success){
                    let data = response.data;
                    // console.log(data);
                    delete data.user_id;
                    formAutoFill(data, "input,select",{attr:"files", target:".upload-img"});
                    let modalcontainer = document.querySelector(".modal-container");
                    modalcontainer.style.display = "flex";
                    form.setAttribute("data-form-type", "edite");
                }
            });
        });
    }
}

function showModal(){
    let ajouteEmployes = document.getElementById("addEmployee")
    if(ajouteEmployes){
        ajouteEmployes.addEventListener('click', function(e){
            let Container = document.querySelector(".modal-container")
            Container.style.display = "flex";
            closeModal(this);
            let form = document.querySelector("form");
            form.reset();
            let img = document.querySelector(".upload-img");
            img.src = "";
            form.setAttribute("data-form-type","add");
        });
    }
}
search('employeeTable',"#select-search","h6");

export function deleteEmployes(){
    let button = document.querySelector('#delete-action');
    if (button) {
        button.addEventListener('click', function(e){
            let formdata = new FormData();
            let buttoncontainer = document.querySelector(".button-container");
            let id = buttoncontainer.dataset.id;
            if(id=="null" || id=="0" && id!=="-1"){
                formdata.append("id", 0);
            }
            else{
                formdata.append("id", id.split(","));
            }
            new FetchRequest(ResolvePath("request/supprimer"), formdata, null, function (response){
                let ids = id.split(",");
                if (response.success === true) {
                    if(ids.length==1 && ids[0]==0){
                        let tbody = document.querySelector("tbody");
                        let checkboxparent = document.querySelector(".parent-checkbox");
                        checkboxparent.checked = false;
                        tbody.innerHTML = "";
                    }
                    if(ids.length>=1){
                        for (let index = 0; index < ids.length; index++) {
                            const element = document.querySelector(`tr[data-id="${ids[index]}"]`);
                            if(element)
                            element.remove();
                        }
                    }
                    
                }

            })
        });
        
    }

}
addEmployes();
showModal();
checkbox('table');
showEmployeAction();
let imageUploader  =new ImageUploader(document.getElementById("photo"),document.querySelectorAll(".upload-img"));
imageUploader.run();
handlePregressFormMethods();
