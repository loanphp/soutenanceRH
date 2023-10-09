import anime from '../../anime-master/anime-master/lib/anime.es.js';
import { focusInBlock, getFocusableElements } from "../../js/function/focus-in-block.js";

let fieldSets = document.querySelectorAll(".fieldset-container");
let params = {form:document.querySelector('form'),fieldsetContainer:document.querySelector("#fieldset-container")};
let element = null;
let pages = [".fieldset1", ".fieldset2",".fieldset3"];

window.addEventListener('keydown', function (e) {
    if (e.key === 'Tab' && element !== null) {
        return focusInBlock(e, element);
    }
})

class StageOne{
    constructor(){
        element = document.querySelector('.fieldset1');
        if(element){
            element.querySelectorAll('input')[0].focus()
            getFocusableElements(element);
        }         
    
        this.next();
    }
    next(){
        document.querySelector('.next1').addEventListener("click", function(){
            let currentFieldset = document.querySelector('.fieldset1');
            let isvalid = isValidFieldset(currentFieldset);
            if(isvalid==true){
                element = document.querySelector('.fieldset2');
                if (element)
                getFocusableElements(element);
                anime({
                    targets: pages,
                    translateX: -575,
                    easing: 'easeInOutExpo'
            });

            }
        });
    }
}


class StageTwo{
    constructor(){
        this.next();
        this.prev(); 
    }
    next(){
        document.querySelector('.next2').addEventListener("click", function(){
            element = document.querySelector('.fieldset3');
            let currentFieldset = document.querySelector('.fieldset2');
            let isvalid = isValidFieldset(currentFieldset);
            if(isvalid==true){
                if(element){
                    getFocusableElements(element);
                    anime({
                        targets: pages,
                        translateX: (-575 * 2) - 10,
                        easing: 'easeInOutExpo'
                    });
                }
            }
        });
    }
    prev(){
        document.querySelector('.prev1').addEventListener("click", function(){
            element = document.querySelector('.fieldset1');
            getFocusableElements(element);
            anime({
                targets: pages,
                translateX: 0,
                easing: 'easeInOutExpo'
            });
        });
    }
}

class StageThree{
    constructor(){
        this.prev();
        this.submit();
    }

    submit(){
        document.querySelector('.save').addEventListener("click", function(e){
            let currentFieldset = document.querySelector('.fieldset3');
            let isvalid = isValidFieldset(currentFieldset);
           if(isvalid=false){
            e.preventDefault();
           }
        });
    }
    prev(){
        document.querySelector('.prev2').addEventListener("click", function(){
            element = document.querySelector('.fieldset2');
            getFocusableElements(element);
            anime({
                targets: pages,
                translateX: -575,
                easing: 'easeInOutExpo'
            });
        });
    }
}
export function  progressFormStyle(params,fieldSets,styleOptions)
{
    const defaultFormStyle = {
        width: '580px',
        height: '100%',
        boxSizing: 'border-box',
        overflow:'hidden',
        boxShadow: '0px 0px 10px rgba(1, 1, 1, 0.1)',
        backgroundColor :'#DDDDDD'
    };

    const defaultFieldsetContainerStyle = {
        width: '1720px',
        height: '100%',
        overflow: 'hidden',
        display: 'flex',
        justifyContent: 'space-between',
        alignItems: 'center',
        flexDirection: 'row',
    };

    const defaultFieldsetStyle = {
        width: ' 100%',
        transition: 'margin-left 0.4s ease-in-out',
        // backgroundColor: '#FFFFFF',
        justifyContent: 'space-between',
        alignItems: 'center',
        display: 'flex;',
        flexDirection: 'column',
        padding: '30px',
        border: 'none',
        boxShadow: '0 0 5px rgba(255, 255, 255, 0.7137254902)',
        borderRadius: '3px',
        height: '100%',
    };

    // Fusionnez les styles par défaut avec les styles personnalisés
    const formStyle = Object.assign({}, defaultFormStyle, styleOptions?.form);
    const fieldsetContainerStyle = Object.assign(
        {},
        defaultFieldsetContainerStyle,
        styleOptions?.fieldsetContainer
    );
    const fieldsetStyle = Object.assign({}, defaultFieldsetStyle, styleOptions?.fieldset);

    Object.assign(params.form.style, formStyle);
    Object.assign(params.fieldsetContainer.style, fieldsetContainerStyle);
    fieldSets.forEach((fieldSet, index) => {
        Object.assign(fieldSet.style, fieldsetStyle);
        // fieldSet.classList.add(`fieldset${index}`);
    });
}
progressFormStyle(params,fieldSets,{});
export function handlePregressFormMethods(){
    new StageOne();
    new StageThree();
    new StageTwo();
}

function isValidFieldset(fieldSet) {
    let fields = Array.from(fieldSet.querySelectorAll("input,select,textarea"));
    let isValid = true; 
     fields.reverse();

    for (const field of fields) {
        if (!field.checkValidity()) {
            field.reportValidity();
            isValid = false; 
        }
    }

    return isValid;
}
const stopPropagation = function(e){
    e.stopPropagation();
}
export function closeModal(openbutton){
    let Form = document.querySelector("form");
    document.addEventListener("click" ,function(e){
        const eventTarget = e.target;
        if(!Form.contains(eventTarget) && !openbutton.contains(eventTarget)){
            let Container = document.querySelector(".modal-container")
            Container.style.display = "none";
        }
    });
    Form.addEventListener("click",stopPropagation);
    
}

