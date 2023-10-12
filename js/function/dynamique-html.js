import { setCheckBoxChildEvent } from "../module/employe-action.js";
export function dynamiqueEmploye(data){
    let tbody = document.createElement('tbody');
    let tdHtml = `<td><input data-id="${data.id}" class="child-checkbox" type="checkbox" name="" id=""></td>`;
    let tbody2 = document.createElement('tbody');
    const html = `   <tr data-id = "${data.id}">
        <td class="photo-employe"><img src="${data.files}" alt="Photo"></td>
        <td><h6 data-texte= "nom_employe">${data.nom_employe}</h6></td>
        <td><h6 data-texte= "prenom_employe">${data.prenom_employe}</h6></td>
        <td><h6 data-texte= "date_de_naissance">${data.date_de_naissance}</h6></td>
        <td><h6 data-texte ="nationalite">${data.nationalite}</h6></td>
        <td><h6 data-texte ="nationalite">${data.date_embauche}</h6></td>
        <td><h6 data-texte ="statu">${data.statut}</h6></td>
    </tr>`;
    tbody2.innerHTML = tdHtml;
    tbody.innerHTML = html;
    let td = tbody2.firstElementChild.firstElementChild;
    let tr = tbody.firstElementChild;
    td.addEventListener("click",setCheckBoxChildEvent);
    tr.insertBefore(td,tr.firstElementChild);
    return tr;
}