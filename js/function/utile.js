// Réinitialise la position de la barre de défilement à l'état initial
export function scrollBarInit(element) {
    if(!element){
        let element = document.documentElement || document.body;

    }
  
    element.scrollTop = 0;
  }
  export function formAutoFill(data,fieldsTarget, imgData = null){
    let fields = document.querySelectorAll(fieldsTarget);
    fields.forEach(field => {
        let nameAttribute = field.getAttribute("name");
        if(imgData!== null && nameAttribute===imgData.attr){
            let inputfile = document.querySelector("form input[type='file']");
            inputfile.setAttribute("value", data["photo"]);
            let img = document.querySelector(imgData.target)
            img.src = data["photo"]
        }
        let value = data[nameAttribute];
        if(value){
            field.value = value;
        }
    })
  }
  

  