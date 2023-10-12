import anime from "../../anime-master/anime-master/lib/anime.es.js";
import { FetchRequest } from "../fetch_request.js";
import { ResolvePath } from "./resolver.js";

function init(){
    let input = document.querySelector(".inp-methode");
    if(input){
        let employe = null;
        let nextButton = document.querySelector(".icone-btn");
        let buttoncontainer = document.querySelector(".buttonContainer");
        let button = null;
        input.addEventListener("input",function(e){
            employe= input.value;
            if(employe!==null && employe!== ""){
                let html = ` <a href="/methode/individuel?code_employe=${employe}" class="icone-btn entretien-btn">
                <span>
                Entretien individuel d'évaluation
                </span>
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M19 2H5a2 2 0 0 0-2 2v14c0 1.1.9 2 2 2h4l2.29 2.29c.39.39 1.02.39 1.41 0L15 20h4c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-7 3.3c1.49 0 2.7 1.21 2.7 2.7s-1.21 2.7-2.7 2.7S9.3 9.49 9.3 8s1.21-2.7 2.7-2.7zM18 16H6v-.9c0-2 4-3.1 6-3.1s6 1.1 6 3.1v.9z"/></svg>
                </span>
                </a>`;
                let div = document.createElement("div");
                div.innerHTML = html;
                button = div.firstElementChild;
            }
            if(employe===""){
                let entretienbtn = buttoncontainer.querySelector(".entretien-btn");
                if(entretienbtn){
                    anime({
                        targets:[".entretien-btn",".next-btn"], 
                        translateX:120, 
                        easing:"easeInOutExpo",
                        duration: 30
                    });
                }
            }
        })
        if(nextButton){
            nextButton.addEventListener("click",function(e){
                if(employe!==null && employe!==""){
                    let formdata = new FormData();
                    formdata.append("numero_securite_sociale", employe);
                    formdata.append("form-type","getEmploye")   
                    let request = new FetchRequest(ResolvePath("request/get/employe/nss"), formdata,null,function(response){
                        if(response.success){
                            buttoncontainer.appendChild(button);
                            let entretienbtn = buttoncontainer.querySelector(".entretien-btn");
                            if(entretienbtn){
                                anime({
                                    targets:[".entretien-btn",".next-btn"], 
                                    translateX:-120, 
                                    // easing:"easeInOutExpo"
                                });
                            }

                        }
                        else{
                            request.getResponse();
                        }
                   })
                }
            });
        }
    }
}

init();