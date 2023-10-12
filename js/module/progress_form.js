import anime from '../../anime-master/anime-master/lib/anime.es.js';
import { focusInBlock, getFocusableElements } from "../function/focus-in-block.js";
import { ProgressFormStyleOptions } from '../interface/ProgressFormStyleOptions.js';

let fieldSetElement = null;

const ProgressFormType = {
  form: null,
  fieldsetContainer: null,
  progress: {
    progressElement: null,
  },
  translateX: 0,
  targetMarginWidth: 0,
};

export class ProgressForm {
  constructor(enableDefaultCssStyle = true) {
    this.element = null;
    this.targetWidth = -625;
    this.fieldsetLength = 0;
    this.enableDefaultCssStyle = enableDefaultCssStyle;
  }

  run(params, styleOptions) {

    const fieldSets = params.form.querySelectorAll('fieldset');
    const progressElement = params.progress ? params.progress.progressElement : undefined;
    let nextIndex = 1;
    let prevIndex = fieldSets.length;
    this.fieldsetLength = fieldSets.length;

    if (fieldSets && fieldSets.length > 1) {
      fieldSets.forEach((fieldSet, i) => {
        const nextButton = fieldSet.querySelector(".next-btn");
        const prevButton = fieldSet.querySelector('.prev-btn');
        const translateX = params.translateX;
        // const nextTranslateX = params.translateX * nextIndex;
        console.log({lili:translateX * nextIndex});
        let prevTranslateX = (translateX * nextIndex) + Math.abs(translateX * 2);
        fieldSetElement = fieldSet;
        fieldSet.classList.add(`fieldset${i}`);

        if (i === 0) {
          let input = fieldSet.querySelectorAll('input')[i];
          if(input){
            input.focus();
          }
          this.setFocusInFieldsest(fieldSetElement);
        }

        this.next(nextButton, nextIndex, params.targetMarginWidth,translateX, progressElement);
        nextIndex++;

        if (i === 0) {
          getFocusableElements(fieldSetElement);
        }
        this.prev(prevButton, prevIndex, nextIndex, prevTranslateX, progressElement);
        prevIndex--;
      });
    }

    const progress = 100 / this.fieldsetLength;

    if (progressElement) {
      progressElement.style.width = `${progress}%`;
    }

    if (this.enableDefaultCssStyle) {
      this.cssStyle(params, fieldSets, styleOptions);
    }
  }

  next(nextButton, nextIndex, targetMarginWidth = 0, translateX, progressElement) {
    const targets = this.fieldsetTargetArray();

    if (nextButton) {
      nextButton.addEventListener("click", (e) => {
        e.preventDefault();
        const fieldSet = document.querySelector(`.fieldset${nextIndex - 1}`);
        const isValid = this.isValidFieldset(fieldSet);

        if (isValid) {
          fieldSetElement = document.querySelector(`.fieldset${nextIndex}`);
          this.setFocusInFieldsest(fieldSetElement);
          getFocusableElements(fieldSetElement);
          if (!translateX) {
            translateX = -625;
          }
          anime({
            targets: targets,
            translateX: (translateX * nextIndex) - targetMarginWidth,
            easing: 'easeInOutExpo',
          });

          if (progressElement) {
            const currentProgress = progressElement.getAttribute("style");
            const progressValue = this.progress;
            nextIndex += 1;
            progressElement.style.width = `${progressValue * nextIndex}%`;
          }
        }
      });
    }
  }

  prev(prevButton, prevIndex, nextIndex, prevTranslateX, progressElement) {
    const targets = this.fieldsetTargetArray();
    if (prevButton) {
      prevButton.addEventListener("click", (e) => {
        prevIndex--;
        e.preventDefault();

        fieldSetElement = document.querySelector(`.fieldset${prevIndex}`);
        this.setFocusInFieldsest(fieldSetElement);
        getFocusableElements(fieldSetElement);

        anime({
          targets: targets,
          translateX: prevTranslateX,
          easing: 'easeInOutExpo',
        });

        if (progressElement) {
          const currentProgress = progressElement.getAttribute("style");
          const progressValue = this.progress;
          nextIndex -= 2;
          progressElement.style.width = `${progressValue / nextIndex}%`;
        }
      });
    }
  }

  get progress() {
    return 100 / this.fieldsetLength;
  }

  setFocusInFieldsest(fieldSet) {
    window.addEventListener('keydown', (e) => {
      if (e.key === 'Tab' && fieldSet !== null) {
        focusInBlock(e, fieldSet);
      }
    }, { once: true });
  }

  isValidFieldset(fieldSet) {
    const inputs = Array.from(fieldSet.querySelectorAll('input'));
    const selects = Array.from(fieldSet.querySelectorAll('select'));
    const textareas = Array.from(fieldSet.querySelectorAll('textarea'));

    for (const input of inputs) {
      if (!input.checkValidity()) {
        input.reportValidity();
        return false;
      }
    }

    for (const select of selects) {
      if (!select.checkValidity()) {
        select.reportValidity();
        return false;
      }
    }

    for (const textarea of textareas) {
      if (!textarea.checkValidity()) {
        textarea.reportValidity();
        return false;
      }
    }

    return true;
  }

  fieldsetTargetArray() {
    let fieldsetTargetArray = [];

    if (this.fieldsetLength > 0) {
      for (let i = 0; i < this.fieldsetLength; i++) {
        fieldsetTargetArray.push(`.fieldset${i}`);
      }
    }

    return fieldsetTargetArray;
  }

  fieldsetAnimation(targets, translateX) {
    for (let i = 0; i < targets.length; i++) {
      const fieldset = document.querySelector(`${targets[i]}`);
      fieldset.style.transform = `translateX(${translateX})`;
    }
  }
  static styleOptions(){
    return ProgressFormStyleOptions;
  }

  cssStyle(params, fieldSets) {
    let style_options = this.styleOptions;
    const defaultFormStyle = {
      width: '440px',
      height: '100%',
      boxSizing: 'border-box',
      overflow: 'hidden',
    };

    const defaultFieldsetContainerStyle = {
      width: `1800px`,
      height: '100%',
      overflow: 'hidden',
      display: 'flex',
      justifyContent: 'space-between',
    };

    const defaultFieldsetStyle = {
      width: '385px',
      height: '100%',
      transition: 'margin-left 0.4s ease-in-out',
      backgroundColor: '#FFFFFF',
      justifyContent: 'space-between',
      alignItems: 'center',
      display: 'flex',
      flexDirection: 'column',
      padding: '30px',
      border: '1px solid #ccc',
      boxShadow: '0 0 5px rgba(0, 0, 0, 0.5)',
      borderRadius: '3px',
    };
    let  formStyle = null;
    let fieldsetContainerStyle = null;
    let fieldsetStyle = null;
    if(!style_options){
      formStyle = Object.assign({}, defaultFormStyle);
      fieldsetContainerStyle = Object.assign({}, defaultFieldsetContainerStyle);
      fieldsetStyle = Object.assign({}, defaultFieldsetStyle);
    }
    else{
      const formStyle = Object.assign({}, defaultFormStyle, style_options.form);
      const fieldsetContainerStyle = Object.assign({}, defaultFieldsetContainerStyle, style_options.fieldsetContainer);
      const fieldsetStyle = Object.assign({}, defaultFieldsetStyle, style_options.fieldset);
    }

    Object.assign(params.form.style, formStyle);
    Object.assign(params.fieldsetContainer.style, fieldsetContainerStyle);

    fieldSets.forEach((fieldSet, index) => {
      Object.assign(fieldSet.style, fieldsetStyle);
      fieldSet.classList.add(`fieldset${index}`);
    });

    const fieldSetWidth = fieldSets[0].offsetLeft -10;
    console.log(fieldSets[0].offsetLeft);
    const fieldsetContainerWidth = this.fieldsetLength * fieldSetWidth - 57;
    params.fieldsetContainer.style.width = `${fieldsetContainerWidth}px`;
  }
}
