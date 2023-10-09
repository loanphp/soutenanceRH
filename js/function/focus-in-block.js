/**
 * Gère le focus clavier sur les éléments d'un bloc HTML spécifié.
 * @param key - L'événement clavier qui a déclenché la fonction.
 * @param block - L'élément HTML qui représente le bloc sur lequel on souhaite gérer le focus.
 */
export function focusInBlock(key, block)
{
    key.preventDefault();
    let index = getFocusableElements(block).findIndex(f => f === block.querySelector(':focus'));
    (key.shiftKey === true) ? index-- : index++;
    if (index >= getFocusableElements(block).length) { index = 0; }
    if (index < 0) { index = getFocusableElements(block).length - 1; }
    const FIELD = getFocusableElements(block)[index];
    FIELD.focus();
}
/**
 * Récupère tous les éléments focusables dans un bloc HTML spécifié.
 * @param block - L'élément HTML qui représente le bloc contenant les éléments focusables.
 * @returns Un tableau d'éléments focusables présents dans le bloc.
 */
export function getFocusableElements(block)
{
    let focusableSelector = "button, select, input, a, textarea";
    return Array.from(block.querySelectorAll(focusableSelector));
}