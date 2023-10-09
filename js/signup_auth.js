import { FetchRequest } from "./fetch_request.js";
import { ResolvePath } from "./function/resolver.js";
let form = document.querySelector('form');
form.addEventListener('submit', function(e){
    e.preventDefault();
    let formdata = new FormData(form);
    let fetchRequest = new FetchRequest(ResolvePath("request/inscription"), formdata, "/connection", function(response){
        fetchRequest.getResponse(response)
    });
});