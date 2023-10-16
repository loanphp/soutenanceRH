export function search(tableAttr,search,searchTextTarget){
    document.addEventListener('DOMContentLoaded', function () {
        const table = document.getElementById(tableAttr);
        const rows = table.getElementsByTagName('tr');
        console.log(search);
        search.addEventListener('input', function () {
            let searchValue = search.value.toLowerCase();
            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                if(row.classList.contains("tr-primary")){
                    row.remove();
                }
                const searchTexte = row.querySelector(searchTextTarget).textContent.toLowerCase(); // Nom
                const shouldShow = searchTexte.includes(searchValue);
                row.style.display = shouldShow ? '' : 'none';
            }
        });
    });
}