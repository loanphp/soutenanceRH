export class ImageUploader
{
    /**
     * @param {HTMLInputElement} inputfile La balise input qui recevra l'image
     * @param {NodeListOf<Element>} imgtarget La balise dans laquelle l'image sera affiché
     */
    constructor(inputfile, imgtarget = [])
    {
        this.inputfile = inputfile;
        this.imgtarget = imgtarget;
        
    }
    run(){
        this.inputfile.addEventListener("change", () => {
            const image = this.inputfile.files[0];
            const imgReader = new FileReader();
            
            imgReader.onload = () => {
                const imgUrl = imgReader.result;
                this.imgtarget.forEach(element => {
                    element.src = imgUrl;
                });
               
            }
            
            imgReader.readAsDataURL(image);
        })
    }
}