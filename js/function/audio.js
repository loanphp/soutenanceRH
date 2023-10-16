import { ResolvePath } from "./resolver.js";
export function SetAudio(audioPath, classname=null) {
    const audio = document.createElement('audio');
    if(classname != null){audio.classList.add(classname);}
    const source = document.createElement('source');
    source.src = ResolvePath(audioPath);
    source.type = "audio/mpeg";
    audio.appendChild(source);
    return audio;
}