import { FetchRequest } from "./fetch_request.js";
import { scrollBarInit } from "../js/function/utile.js";
import { ResolvePath } from "./function/resolver.js";
import { formAutoFill } from "../js/function/utile.js";
import { search } from "./function/search.js";
function leaveAsking(){
    let form = document.querySelector('form');
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');
    getLeave();
    if(form){
        form.addEventListener("submit", function(e){
            e.preventDefault();
            let formdata = new FormData(form);
            if(id==null){
                formdata.append("id",0);
                formdata.append("form_type","add");
            }
            if(id!==null){
                formdata.append("form_type","update");
                formdata.append("id",id);
            }
            let fetchRequest = new FetchRequest(ResolvePath("request/conges"), formdata, ResolvePath("liste/conges"), function(response){
                fetchRequest.getResponse(response)
                scrollBarInit(document.body);
            });
    
        });
    }
}
function getLeave(){
    const params = new URLSearchParams(window.location.search);
    const id = params.get('id');
    let formdata = new FormData();
    if(id){
        formdata.append("id", id);
        formdata.append("form_type","get");
        new FetchRequest(ResolvePath("request/get/conges"), formdata, null,function(response){
            if(response.success){
                formAutoFill(response.data, "input,select,textarea",);
            }
        });
    }
}

function deleteLeave(){
    let leavebuttons = document.querySelectorAll('.div-delete-action');
    if (leavebuttons) {
        leavebuttons.forEach(leavebutton => {
            let id = leavebutton.dataset.delete
            console.log(id);
            if (id) {
                leavebutton.addEventListener('click', function (e) {
                    let formdata = new FormData();
                    formdata.append('id',id);
                    let resultat = confirm("Voulez-vous vraiment supprimer cette demande ?");
                    if (resultat === true) {
                        new FetchRequest(ResolvePath("request/delete/conges"), formdata, null, function (response) {
                            if(response.success){
                                let tr = document.querySelector(`.leave${id}`);
                                tr.remove();
                            }
        
                        })
                        
                    } 
                });
            }
        })

    }
}

function findDate(){
    
let debut = document.getElementById("date_de_debut");
let fin = document.getElementById("date_de_fin");
let start_date = null;
if(debut && fin){
    
    debut.addEventListener("input", function(){
        start_date = new Date(this.value);
        fin.min = start_date.toISOString().split("T")[0];
    });
    fin.addEventListener("input", function(){
        let end_date = new Date(this.value);
        if( start_date > end_date ){
            fin.value = start_date.toISOString().split("T")[0];
        }
        let duree = months(start_date, end_date);
        document.getElementById("duree").value = duree
    });
}

let days = function (start_date, end_date){
    let one_day = 24 * 60 * 60 * 1000;
    let valeur_absolue = Math.abs(end_date - start_date);
    let days = Math.floor(valeur_absolue / one_day);
    return days;
}

function weeks(start_date = null, end_date = null,extday = null) {
    let totaldays = extday??days(start_date, end_date);
    let number_weeks =  Math.floor(totaldays/7); 
    extday = totaldays % 7;
    return {weeks: number_weeks, extday: extday};
}

function months(start_date, end_date){
    let totaldays = days(start_date, end_date);
    let number_months = Math.floor(totaldays / 30);
    let extday = totaldays % 30;
    let totalweeks = weeks(null, null, extday);
    if(totaldays<30){
        let jours = weeks(null,null,totaldays).extday;
        let semaines = weeks(null,null,totaldays).weeks;
        return `${semaines} semaine(s) et ${jours} jour(s)`;
    }
    else{
        let semaines = totalweeks.weeks;
        let jours = totalweeks.extday;
        let mois = number_months;
        return `${mois} mois , ${semaines} semaine(s) et ${jours} jour(s)`;

    }
}

// function years(start_date, end_date){
//     // Code relatif au calcul des années
// }
}
function changeStatus(){
    let inputs = document.querySelectorAll(".form-check-input");
    if(inputs){
        inputs.forEach(input => {
            let id = input.dataset.id
            let value = input.dataset.value
            let formdata = new FormData()
            formdata.append("status"+id,value)
            formdata.append("id",id)
            new FetchRequest("request/conges/status", formdata,null,function(response){},input,false)
            
        });
    }
}
// getLeave();
deleteLeave();
changeStatus();
findDate();
leaveAsking();
search("table-leave","#select-search","td");