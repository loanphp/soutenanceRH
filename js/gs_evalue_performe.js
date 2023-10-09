import { FetchRequest } from "./fetch_request.js";
let form = document.querySelector('form');
form.addEventListener('submit', function(e){
    e.preventDefault();
    let formdata = new FormData(form);
    let fetchRequest = new FetchRequest("request/evaluation_de_performances", formdata, null, function(response){
        fetchRequest.getResponse(response)
    });
});