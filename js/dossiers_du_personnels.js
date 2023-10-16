import { FetchRequest } from "./fetch_request.js";
import { openFile } from "./pdf.js";
import { transform } from "./pdf.js";
import { ResolvePath } from "./function/resolver.js";
import { convertBase64FileToFile, forbiddener } from "./function/utile.js";
import { Popup } from "./module/alert.js";
import {shortenedText} from "./function/utile.js";

let viewcontainer = document.querySelector('tbody');
let form = document.querySelector('form');
let addbutton = document.querySelector('.add');
let addsend = document.querySelector('.send');
let update = false;

function hideFile(){
    let close_button = document.querySelector("#closeModalBtn")    
    close_button.addEventListener('click', function(){
        let pdfModal = close_button.closest("#pdfModal");
        pdfModal.style.display = 'none';
    });
}
hideFile();

function deleteFile(delete_button){
    delete_button.addEventListener('click', function(e){
        e.preventDefault();
        let tr = delete_button.closest('tr');
        tr.remove();
    });
}


function showFile(openbutton){
    openbutton.addEventListener('click', function(e){
        e.preventDefault();
        let tr = openbutton.closest('tr');
        let pdf = tr.dataset.url;
        openFile(pdf);
    });
}

function saveFile(){
    let employee_name = document.querySelector('#id_employe');
    let numero_securite_sociale = null;
    employee_name.addEventListener('change',function(){
        numero_securite_sociale = employee_name.value
    })
    form.addEventListener('submit',function(e){
        e.preventDefault();
        let data = {};
        let filesview = document.querySelectorAll('.file_view');
        if(filesview===null){
            let formData = new FormData();
            let pdfFile = document.querySelector('input[type="file"]').files[0];
            if(pdfFile){
                for (const pair of formData.entries()) {
                    const [key, value] = pair;
                    if (key === "files"){
                        formData.append("files",value.name);
                    }
                }
                formData.append(this);
                formData.append("form_type", form.dataset.formType);
                new FetchRequest(ResolvePath("request/dossier_du_personnel"),formData,null,function(response){
                    if(true === response.success){
                        return handleRequestMessage({title:'Succès !',message:response.message,type:'success'});
                    }
                    if(false === response.success){
                        return handleRequestMessage({title:'Erreur !',message:response.message,type:'danger'});
                    }
                });  
            }
        }else {
            let success = null
            filesview.forEach((element, i) => {
                let formData = new FormData();
                let file = element.querySelector(".file");
                let file_type = element.querySelector(".file_type");
                let file_url  = element.dataset.url
                let file_name = element.dataset.name;
                formData.append("files", transform(file.dataset.file,file_name,"application"));
                formData.append("file_type", file_type.dataset.type);
                formData.append("file_url", file_url);
                formData.append("numero_securite_sociale", numero_securite_sociale);
                if(form.dataset.formType === "update"){formData.append("form_type", "update");}
                else{
                    if(i===0){formData.append("form_type", "insert");}
                    else{formData.append("form_type", "update");}
                }
                new FetchRequest(ResolvePath("request/dossier_du_personnel"),formData,null,function(response){
                    if(i >= filePreview.length){
                        if(true === response.success){
                            let tr = document.querySelector("tbody");
                            if(tr!==null){tr.innerHTML = ""}
                            return handleRequestMessage({title:'Succès !',message:response.message,type:'success'});
                        }
                    }
                    if(false === response.success){
                        return handleRequestMessage({title:'Erreur !',message:response.message,type:'danger'});
                    }
               });  
            });
        }   
    });
}

function addFile(){
    addbutton.addEventListener('click',async function(e){
        e.preventDefault();
        let formData = new FormData(form);
        let data = {};
        for (const pair of formData.entries()) {
            const [key, value] = pair;
            if (key === "files"){
                let file_url = document.querySelector('input[type="file"]').files[0];
                data["file_url"] = URL.createObjectURL(file_url);
                data["files"] = await getFile(file_url);
                data["file_name"] = value.name;
            }
            else {
                data["file_type"] = value; 
            }
        }
        let filepreview = filePreview(data);
        let showbutton = filepreview.querySelector(".showbutton"); 
        showFile(showbutton);
        let delete_button = filepreview.querySelector(".delete");
        viewcontainer.appendChild(filepreview);
        deleteFile(delete_button);
        form.reset();
    });
}
function getFile(pdfFile){
    return new Promise((resolve, reject)=>{
        const reader = new FileReader();
        reader.onloadend = () => {
            resolve(reader.result);
        }
        reader.onerror = () =>{
            reject(reader.result);
        }
        reader.readAsDataURL(pdfFile);
    })

}
function filePreview(data) {
    let htmlString = `
    <tr data-numero ="${data.numero_securite_sociale}" class="file_view" data-url="${data.file_url}" data-name=${data.file_name}>
    <td class="file_type col-3" data-type="${data.file_type}"><h6>${data.file_type}</h6></td>
    <td class="file col-6" data-file="${data.files}"><h6>${shortenedText(data.file_name)}</h6></td>
    <td class="col-3">
        <div class="button_container">
            <button class="btn btn-danger delete" ><i class="fas fa-trash"></i></button>
            <button class="btn btn-dark showbutton"><i class="fas fa-eye"></i></button>
        </div>
    </td>
</tr>`;
    let tbody = document.createElement('tbody');
    tbody.innerHTML = htmlString;
    return tbody.firstElementChild
}
function getEmployeFiles(){
    let select = document.querySelector('#id_employe');
    let selected = false;
    let index = 0;
    select.addEventListener('change', function(){
        if(false === selected){
            let numero_securite_sociale = null;
            let file_view_container = document.querySelector('.tbody');
            let forbiddenParent = forbiddener("tr");
            let button = document.querySelector("#dossier_employe");
            let lastNSS = null;
            if(index===0){
                numero_securite_sociale = select.value;
                index = 1;
            }
            if(index===1){
                lastNSS = select.value;
                index = 0;
            }
           if((lastNSS!==null && lastNSS!== numero_securite_sociale) || index===0){
             if(select.value!==""){
                button.href =`/tableau/documents?id=${select.value}`
                button.removeAttribute("disable");
                button.classList.remove("disabled");
            }
            file_view_container.appendChild(forbiddenParent)
            if(numero_securite_sociale && numero_securite_sociale!==""){
                let formData = new FormData();
                formData.append("numero_securite_sociale", numero_securite_sociale);
                formData.append("formtype", "get");
                new FetchRequest(ResolvePath("request/get/documents/employe"), formData, null, async function(response){
                    if(response!==false && response!==true){
                        let dossiers = response.data;
                        for (const dossier in dossiers) {
                            if (Object.hasOwnProperty.call(dossiers, dossier)) {
                                const filename = dossiers[dossier];
                                if (dossier !== "id" && dossier !== "numero_securite_sociale" && filename !== "") {
                                    const file_data = await getPDFFile(filename,dossier);
                                    let file_url = file_data.file_url;
                                    let file_name = file_data.file_name;
                                    let file_type = file_data.file_type;
                                    let files = file_data.file_blob;
                                    const data = {file_url,file_name,file_type,files,numero_securite_sociale};
                                    let filepreview = filePreview(data);
                                    let showbutton = filepreview.querySelector(".showbutton"); 
                                    showFile(showbutton);
                                    let delete_button = filepreview.querySelector(".delete");
                                    checkLastFile(filepreview);
                                    viewcontainer.appendChild(filepreview);
                                    deleteFile(delete_button);
                                }
                            }
                        }
                        
                    }
                    if(null !== response.data){form.dataset.formType = "update"}
                    if(null === response.data){
                        form.dataset.formType = "insert"
                        viewcontainer.innerHTML = "";
                    }
                    let forbidder = document.querySelector(".forbidden-parent");
                    if(forbidder){forbidder.remove()}
                    // selected = true;

                    return {update}
                })
            
            }

           }
        }
    });
}
function checkLastFile(tr){
    let numero_securite_sociale = tr.dataset.numero;
    let trs = document.querySelectorAll(".file_view");
    trs.forEach(element => {
        if(element.dataset.numero !== numero_securite_sociale){
            element.remove();
        }
        
    });
}
async function getPDFFile(filename,dossier){
    const request = await fetch(`request/get/pdf?file=${filename}`);
    const response = await request.json();
    if (response.success === true) {
        const base64EncodedFile = convertBase64FileToFile(response.base64EncodedFile, 'application/pdf');
        const blob = await getFile(base64EncodedFile);
        const file = new File([blob], filename+".pdf");
        let url = URL.createObjectURL(base64EncodedFile);
        return {
            file: file,
            file_url: url,
            file_name: filename,
            file_type: dossier,
            file_blob: blob
        };
    }
}
function handleRequestMessage(data={title,message,type}){
    const modal = new Popup();
    const flash_modal = document.querySelector("flash-modal");
    if(flash_modal){flash_modal.remove()}
    modal.display({title:data.title, type:data.type, message:data.message})
    modal.handleAudio(5000, {set:true, path:'public/popupsing.wav', volume:0.7});
}
getEmployeFiles();
addFile();
saveFile();