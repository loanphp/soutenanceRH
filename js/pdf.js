 // import pdfjsLib from '../pdfjs/build/pdf.js';

 export function openFile(file_url) {
    if (file_url) {
        let pdfViewer = document.getElementById('pdfViewer');
        pdfViewer.setAttribute('src', file_url);
        document.getElementById('pdfModal').style.display = 'flex';
        // document.getElementById('downloadLink').style.display = 'block';
    }
    
    
}
export function transform(base64Pdf,filename=null,file_type= "image")
{
  const byteCharacters = window.atob(base64Pdf.split(',')[1]);
  const byteArrays = [];
  let _filename = "";
  for(let offset = 0; offset < byteCharacters.length; offset += 512){
      const slice = byteCharacters.slice(offset, offset + 512);
      const byteNumbers = new Array(slice.length);
      for(let i = 0; i < slice.length; i++) {
          byteNumbers[i] = slice.charCodeAt(i);
      }
      const byteArray = new Uint8Array(byteNumbers);
      byteArrays.push(byteArray);
  }
  const extension = base64Pdf.split(',')[0].split(':')[1].split(';')[0].split('/')[1];
  if(filename){
    _filename = filename;
  }else{
    _filename = `tranformed_file.${extension}`;
  }
  const pdfFile = new File(byteArrays, _filename,{ type: `${file_type}/${extension}` });
  
  return pdfFile
}




