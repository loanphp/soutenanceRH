import { deleteEmployes, editeEmploye } from "../gs_employes.js";
import { checkbox } from "../function/checkbox.js";

export function showEmployeAction(){
    let checkboxes = document.querySelectorAll('.parent-checkbox,.child-checkbox');
    let buttoncontainer = document.querySelector('.button-container');
    checkboxes.forEach(checkboxe => {
        checkboxe.addEventListener('click',function(e){
            let actioncontainer = null;
            let dataId = getDataId();
            if(checkboxe.classList.contains('parent-checkbox')){
                actioncontainer = actionButtons();
                let ischecked = isChecked(this);
                if(ischecked){
                    buttoncontainer.dataset.id = "0";
                    buttoncontainer.innerHTML = ""
                    buttoncontainer.appendChild(actioncontainer);
                }
                else{
                    buttoncontainer.dataset.id = "-1";
                    buttoncontainer.innerHTML = ""
                    actioncontainer.classList.remove("slide-top");
                    actioncontainer.classList.add("slide-bottom");
                    buttoncontainer.appendChild(actioncontainer);
                    setTimeout(() => {
                        actioncontainer.remove()
                    }, 500);

                }
            }
            if(checkboxe.classList.contains('child-checkbox')){
                setCheckBoxChildEvent();

                
            }
            editeEmploye();
            deleteEmployes();
            checkbox("table");
        });
        
    });
}
function isSingleCheckedElement(){
    let childrencheckbox = document.querySelectorAll(".child-checkbox");
    let areChildrenCheckedArray = [];
    const areChecked = Array.from(childrencheckbox).filter(element=>{
        if(element.checked){
            areChildrenCheckedArray.push(element)
        }
    }) 
    if(areChildrenCheckedArray.length==1){
        return true;
    }
    if(areChildrenCheckedArray.length>1){
        return false;
    }
    if(areChildrenCheckedArray.length<1){
        return null;
    }
}

export function setCheckBoxChildEvent(){
    let dataId = getDataId();
    let actioncontainer = actionButtons(dataId);
    let elements = areAllChildrenChecked();
    let isChecked = elements.isChecked;
    let buttoncontainer = document.querySelector('.button-container');
    if (isChecked) {
        buttoncontainer.innerHTML = ""
        buttoncontainer.appendChild(actioncontainer);
    }
    if (!isChecked) {
        buttoncontainer.innerHTML = ""
        actioncontainer.classList.remove("slide-top");
        actioncontainer.classList.add("slide-bottom");
        buttoncontainer.appendChild(actioncontainer);
        setTimeout(() => {
            actioncontainer.remove()
        }, 500);
    }
}
function actionButtons(id="-1"){
    let isSingleChecked = isSingleCheckedElement();
    // console.log(isSingleChecked);
    let buttoncontainer = document.querySelector(".button-container");
    buttoncontainer.dataset.id = id;
    let div = document.createElement('div');
    let editedbutton = isSingleChecked ? 
    `<button type="button" id="edite-action"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M16.477 3.004c.167.015.24.219.12.338l-8.32 8.32a.75.75 0 0 0-.195.34l-1 3.83a.75.75 0 0 0 .915.915l3.829-1a.751.751 0 0 0 .34-.196l8.438-8.438a.198.198 0 0 1 .339.12a45.723 45.723 0 0 1-.06 10.073c-.223 1.905-1.754 3.4-3.652 3.613a47.468 47.468 0 0 1-10.461 0c-1.899-.213-3.43-1.708-3.653-3.613a45.672 45.672 0 0 1 0-10.611C3.34 4.789 4.871 3.294 6.77 3.082a47.512 47.512 0 0 1 9.707-.078Z"/><path fill="currentColor" d="M17.823 4.237a.25.25 0 0 1 .354 0l1.414 1.415a.25.25 0 0 1 0 .353L11.298 14.3a.253.253 0 0 1-.114.065l-1.914.5a.25.25 0 0 1-.305-.305l.5-1.914a.25.25 0 0 1 .065-.114l8.293-8.294Z"/></svg></button>`:
    "";
    let showdbutton = isSingleChecked ? 
    `<a href= "/details/employe?id=${id}" id="show-action"><svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><circle cx="256" cy="256" r="64" fill="currentColor"/><path fill="currentColor" d="M394.82 141.18C351.1 111.2 304.31 96 255.76 96c-43.69 0-86.28 13-126.59 38.48C88.52 160.23 48.67 207 16 256c26.42 44 62.56 89.24 100.2 115.18C159.38 400.92 206.33 416 255.76 416c49 0 95.85-15.07 139.3-44.79C433.31 345 469.71 299.82 496 256c-26.38-43.43-62.9-88.56-101.18-114.82ZM256 352a96 96 0 1 1 96-96a96.11 96.11 0 0 1-96 96Z"/></svg></a>`:
    "";

    let html = ` <div class="action-container slide-top">
    <button type="button" id="delete-action"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="currentColor" d="M9 17h2V8H9v9Zm4 0h2V8h-2v9Zm-8 4V6H4V4h5V3h6v1h5v2h-1v15H5Z"/></svg></button>
    ${showdbutton}
    ${editedbutton}
        </div>`;
    div.innerHTML = html;
    return div.firstElementChild;
}
function isChecked(checkboxbutton){
    if (checkboxbutton.checked){
        return true;
    }
    if (!checkboxbutton.checked){
        return false;
    }
}
function areAllChildrenChecked(){
    let childrencheckbox = document.querySelectorAll(".child-checkbox");
    let areChildrenCheckedArray = [];
    let areNotChildrenCheckedArray = [];
    const areChecked = Array.from(childrencheckbox).filter(element=>{
        if(element.checked){
            areChildrenCheckedArray.push(element)
        }
        if(!element.checked){
            areNotChildrenCheckedArray.push(element)
        }
    }) 
    if(areChildrenCheckedArray.length >= 1){
        return {isChecked:true, elements:areChildrenCheckedArray};
    }
    if(areChildrenCheckedArray.length < 1){
        return {isChecked:false, elements:null};
    }
}
function getDataId(){
    let elements = areAllChildrenChecked();
    let isChecked = elements.isChecked;
    let element = elements.elements;
    if(element && isChecked == true && element.length>1){
        let ids = [];
        for (let i = 0; i < element.length; i++){
            ids.push(element[i].dataset.id);               
        }
        return ids;
    } 
    if(element && isChecked && element.length == 1){
        return element[0].dataset.id;
    }
    if(isChecked == false){
        return null;
    }
}