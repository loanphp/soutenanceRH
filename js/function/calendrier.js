import { FetchRequest } from "../fetch_request.js";
import { ProgressForm } from "../module/progress_form.js";
import { ResolvePath } from "./resolver.js";

let conges = getConges();
const couleurAleatoire = () => {
    return '#' + (Math.random() * 0xFFFFFF << 0).toString(16).padStart(6, '0');
};
function getConges(){
    let calendar = document.querySelector(".calendarContainer");
    let div = document.createElement('div');
    let div2 = document.createElement('div');
    div.classList.add("spinner");
    div2.classList.add("spinnerContainer");
    div2.appendChild(div);
    calendar.appendChild(div2);
    let congesdate = {};
    new FetchRequest(ResolvePath("request/get/conges"),{form_type:"get"}, null, function(response){
        let data = response.data;
        data.forEach((dt,i) => {
            congesdate[i] = {
                "date_de_debut": dt["date_de_debut"],
                "date_de_fin": dt["date_de_fin"],
                "nom_employe": dt["nom_employe"]
            }
            
        });
        afficherConges(congesdate);
    }) 
    return congesdate;
}

function afficherConges(conges) {
    $('#calendar').fullCalendar('removeEvents');
    for (const key in conges) {
        if (conges.hasOwnProperty(key)) {
            const conge = conges[key];
       
            const dateAujourdhui = moment();
            const dateDebut = moment(conge.date_de_debut);
            const dateFin = moment(conge.date_de_fin);
            const couleur = conge.color || couleurAleatoire(); // Utiliser la couleur existante ou générer une nouvelle

            while (dateDebut.isBefore(dateFin)) {
                const jourConge = dateDebut.format('YYYY-MM-DD');

                const jourCongeEvent = {
                    title: conge.nom_employe,
                    start: jourConge,
                    color: couleur,
                    className: 'conge-event'
                };

                if (dateDebut.isBefore(dateAujourdhui)) {
                    jourCongeEvent.className += ' jour-ecoule';
                }

                $('#calendar').fullCalendar('renderEvent', jourCongeEvent, true);
                dateDebut.add(1, 'days');
            }
            let spinnerContainer = document.querySelector(".spinnerContainer");
            if(spinnerContainer){
                spinnerContainer.remove();
            }
        }
    }
}

function afficherFormulaire() {
    $('#demande-conge-form').show();
}

function soumettreDemande() {
    const dateDebut = $('#date_de_debut').val();
    const dateFin = $('#date_de_fin').val();
    const typeConge = $('#type_conges').val();
    const nomemploye = $('#nom_employe').val();
    const couleur = couleurAleatoire(); // Générer une nouvelle couleur

    const conge = {
        title: nomemploye, // Le nom de l'employé est inclus comme titre
        start: dateDebut,
        end: dateFin,
        color: couleur, // La couleur est différente pour chaque événement
        type: typeConge, // Le type de congé est stocké comme une propriété séparée
    };

    conges.push(conge);
    $('#demande-conge-form').hide();
    afficherConges();
}


$(document).ready(function() {
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        defaultView: 'month',
        events: conges,
        selectable: true,
        select: function (start, end) {
            const typeConge = prompt('Type de Congés:');
            const nomemploye = prompt('Nom employé:');
            if (typeConge && nomemploye) {
                soumettreDemande();
            }
        },
        eventOverlap: false, // Empêcher le chevauchement des événements
        eventRender: function (event, element) {
            element.css('white-space', 'normal');
        }
    });
});

