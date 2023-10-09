import { FetchRequest } from "../fetch_request.js";
import { ProgressForm } from "../module/progress_form.js";
import { ResolvePath } from "./resolver.js";
let progressForm = new ProgressForm(true);
let form = document.querySelector("form");
let fieldsetContainer = document.querySelector(".fieldset-container")
let translateX = -420;
progressForm.run({form, fieldsetContainer,translateX});

function addEvaluation(){
    form.addEventListener("submit",function(e){
        e.preventDefault();
        let formdata = new FormData(form);
        const params = new URLSearchParams(window.location.search);
        const code_employe = params.get('code_employe');
        formdata.append("code_employe",code_employe);
        let request = new FetchRequest(ResolvePath("request/entretien/individuel"),formdata, null, function(response){
            request.getResponse();
        })
    })
}
addEvaluation();
