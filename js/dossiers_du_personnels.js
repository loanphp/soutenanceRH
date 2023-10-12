import { FetchRequest } from "./fetch_request.js";
import { openFile } from "./pdf.js";
import { transform } from "./pdf.js";
import { ResolvePath } from "./function/resolver.js";

let viewcontainer = document.querySelector('tbody');
let form = document.querySelector('form');
let addbutton = document.querySelector('.add');
let addsend = document.querySelector('.send');

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
    form.addEventListener('submit',function(e){
        e.preventDefault();
        let data = {};
        let filesview = document.querySelectorAll('.file_view');
        if(filesview===null){
            let formData = new FormData();
            var pdfFile = document.querySelector('input[type="file"]').files[0];
            if(pdfFile){
                for (const pair of formData.entries()) {
                    const [key, value] = pair;
                    if (key === "files"){
                        formData.append("files",value.name);
            
                    }
                }
                formData.append(this);
                new FetchRequest(ResolvePath("request/dossier_du_personnel"),formData,null,function(response){
                });  
            }
        } 
        else {
             filesview.forEach(element => {
                let formData = new FormData();
                let file = element.querySelector(".file");
                let file_type = element.querySelector(".file_type");
                let file_url  = element.dataset.url
                let file_name = element.dataset.name;
                formData.append("files", transform(file.dataset.file,file_name,"application"));
                formData.append("file_type", file_type.dataset.type);
                formData.append("file_url", file_url);

                let resquest = new FetchRequest(ResolvePath("request/dossier_du_personnel"),formData,null,function(response){
                    if(response.success===true){
                        let tr = document.querySelector("tbody");
                    
                        if(tr!==null){
                            tr.innerHTML = "";
                        }
                    }
                    let message = resquest.getResponse(response);

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
    
        // Parcourir les paires clé-valeur
        for (const pair of formData.entries()) {
            const [key, value] = pair;
            if (key === "files"){
                let file_url = document.querySelector('input[type="file"]').files[0];
                console.log(file_url);
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
addFile();

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
    <tr class="file_view" data-url="${data.file_url}" data-name=${data.file_name}>
    <td class="file_type col-3" data-type="${data.file_type}"><h6>${data.file_type}</h6></td>
    <td class="file col-6" data-file="${data.files}"><h6>${data.file_name}</h6></td>
    <td class="col-3">
        <div class="button_container">
            <button class="btn btn-danger delete" ><i class="fas fa-trash"></i></button>
            <button class="btn btn-dark showbutton"><i class="fas fa-eye"></i></button>
        </div>
    </td>
</tr>
    
    `;
    let tbody = document.createElement('tbody');
    tbody.innerHTML = htmlString;
    return tbody.firstElementChild
}
function getEmployeFiles(){
    let select = document.querySelector('#id_employe');
    select.addEventListener('change', function(){
        let numero_securite_sociale = select.value;
        if(numero_securite_sociale && numero_securite_sociale!==""){
            let formData = new FormData();
            formData.append("numero_securite_sociale", numero_securite_sociale);
            formData.append("formtype", "get");
           new FetchRequest(ResolvePath("request/get/documents/employe"), formData, null, function(response){
            if(response!==false && response!==true){
                let dossiers = response.data;
                getPDFFile(dossiers);
                let file_url = null;
                let file_name = null;
                let file_type = null;
                let files = null;
                console.log(response.data);

            }
           })
        

        }
    });

}
function getPDFFile(dossiers){
    for (const dossier in dossiers) {
        if (Object.hasOwnProperty.call(dossiers, dossier)) {
            const filename = dossiers[dossier];
            if(dossier!=="id" && dossier!=="numero_securite_sociale" && filename!==""){
                fetch(`request/get/pdf?file=${filename}.pdf`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erreur de chargement du fichier');
                        }
                        return response.text();
                    })
                    .then(content => {
                        console.log(content);
                    })
                    .catch(error => {
                        console.error(error);
                });

            }
        }
    }
}
getEmployeFiles();
saveFile();