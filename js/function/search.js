export function search(tableAttr,searchSelectAttr,searchTextTarget){
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search');
        const table = document.getElementById(tableAttr);
        const rows = table.getElementsByTagName('tr');

        searchInput.addEventListener('keyup', function () {
            let search = document.querySelector(searchSelectAttr);
            let searchValue = searchInput.value.toLowerCase();
            let selectedIndex = search.selectedIndex;

            let selectedOption = search.options[selectedIndex];
            let searchType = selectedOption.value.toLowerCase();;

            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const searchTexte = row.querySelector(`${searchTextTarget}[data-texte='${searchType}']`).textContent.toLowerCase(); // Nom
                const shouldShow = searchTexte.includes(searchValue) ;
                row.style.display = shouldShow ? '' : 'none';
            }
        });
    });
}