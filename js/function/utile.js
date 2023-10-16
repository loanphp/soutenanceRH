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

  export function convertBase64FileToFile(base64String, mimeType)
  {
    let byteCharacters = atob(base64String);
    let byteNumbers = new Array(byteCharacters.length);
    for (let i = 0; i < byteCharacters.length; i++) {
        byteNumbers[i] = byteCharacters.charCodeAt(i);
    }let byteArray = new Uint8Array(byteNumbers);
    return new Blob([byteArray], { type: mimeType });
  }


export function forbiddener(target="div"){
    const forbiddenParent = document.createElement(target);
    const spinner = document.createElement('div');
    spinner.classList.add('spinner') ;
    forbiddenParent.classList.add('forbidden-parent');
    forbiddenParent.appendChild(spinner);
    return forbiddenParent;
}
export function shortenedText(text, maxLength = 14) {
    text = text.trim();
    if (text.length > maxLength) {
      return `${text.substring(0, maxLength)}...`;
    }
    return text;
}
  

  