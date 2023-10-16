import { ResolvePath } from "../function/resolver.js";
import { SetAudio } from "../function/audio.js";
export class Alert {
    constructor(){
      this.alertModal = document.createElement('alert-modal');
      this.alertModal.setAttribute('class', 'flash-modal');
      this.alertModal.setAttribute('aria-hidden', 'true');
    }
    closeModal = () => {
      const modal = this.alertModal;
      modal.setAttribute('aria-hidden', 'true')
      modal.style.opacity = "0";
      setTimeout(() => {
        modal.remove();
      }, 150);
    };
    openModal = (timer = 0, audio={set:false, path:'', volume:1}) => {
      document.body.insertBefore(this.alertModal, document.body.firstChild);
      if(audio.set == true && audio.path != ''){
        const modalsound = SetAudio(audio.path);
        modalsound.volume = audio.volume;
        modalsound.play();
      }
      const modal = this.alertModal;
      modal.setAttribute('aria-hidden', 'false')
      modal.style.opacity = "1";
      modal.style.display = "flex";
       if(timer > 0){
        setTimeout(() => {
          this.closeModal();
        }, timer);
       }
      
      };
      render(data = {title:'Erreur !', type:'danger', message:''}) {
        this.alertModal.setAttribute('aria-labelledby', data.type.split(" ")[0])
        this.alertModal.classList.add(data.type);
        const modalContent = (
          `<span class="alert-header">
              <h6>${data.title}</h6>
              <svg id="close-modal">
                <use xlink:href=${ResolvePath(`public/svg/alert.svg#close-modal`)} />
              </svg>
            </span>
            <span class="alert-content">
              <h6 class="text">
                  ${data.message}
              </h6>
              <h6>
                <svg>
                  <use xlink:href=${ResolvePath(`public/svg/alert.svg#${data.type}`)} />
                </svg>
              </h6>
            </span>`
        );
        this.alertModal.innerHTML = modalContent;
        const closeModalBtn = this.alertModal.querySelector('#close-modal');
        closeModalBtn.addEventListener('click', this.closeModal);
      }
  }

  export class Popup{
    constructor() {
      this.alert = new Alert();
    }
    display(data={title, type, message}){
      this.alert.render(data);
    }
    handleAudio(timer=0, audio={set:false, path:'', volume:1}){
      this.alert.openModal(timer, audio);
    }
}