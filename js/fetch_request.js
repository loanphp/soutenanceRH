
export class FetchRequest{
    constructor(uri, data, redirectUrl=null,  postFetchAction=(response)=>{},submiter, preFetchAction=async()=>{}, method = "POST") {
        this.data = data;
        this._response = null;
        this.uri = uri;
        this.redirectUrl = redirectUrl;
        this.postFetchAction = postFetchAction;
        this.preFetchAction = preFetchAction;
        this.method = method;
        if(submiter){

            submiter.addEventListener('click', this.handleCustomButtonClick);
        } 
        else{
            this.handleCustomButtonClick()
        }
    }
    handleCustomButtonClick = async ()=>{
        this.submitForm();
    };
    submitForm = async () => {
        let formData= null;
        if(!this.data){
            throw new Error("No Data");
        }
        if(typeof this.preFetchAction === 'function') {
            let data = await this.preFetchAction();
            if(data){
                this.data = data.data;
            }
        }
        if(this.data instanceof FormData){
            formData = this.data;
        }else if(Array.isArray(this.data)){
            formData = JSON.stringify({ data: this.data})
        }else if(typeof this.data === 'object'){
            formData = new FormData();
            let data = this.data 
            for(const key in this.data) {
                if(this.data.hasOwnProperty(key)) {
                    formData.append(key, data[key]??"");
                }
            }
        }


        try{
            if(!this.uri){
                throw new Error("L'URL est obligatoire");
            }
            const response = await fetch(this.uri, {
                method: this.method,
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest' //Pour permettre au serveur de savoir qu'il s'agit d'une requete ajax
                }
            });
            const dataResponse = await response.json();
            return this.postFetchAction(dataResponse);
        }catch(error){
            console.error('Erreur lors de l\'envoi du formulaire : ', error);
        }
    };

    
    getResponse(response) {
        if(response !== null){
            const success = response["success"]
        
            if(success === false){
                let message = response["message"]
                let message_container = document.querySelector(".message_container")
                let html = `<div class="alert alert-danger" role="alert">
                ${message}
            </div>`;
            if(message_container)
            message_container.innerHTML = html;
            }
            else{
                let message = response["message"]
                let message_container = document.querySelector(".message_container")
                let html = `<div class="alert alert-success" role="alert">
                ${message} 
            </div>`;
            if(message_container)
            message_container.innerHTML = html;
            console.log(this.redirectUrl);
            if(this.redirectUrl!==null){
                window.location.href = this.redirectUrl;
            }
         
    
            }
        }
    }
}