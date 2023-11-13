<!DOCTYPE html>
<html>
<head>
    <title>Graphique des appréciations par jour</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="appreciationChart" width="400" height="200"></canvas>

    <script>
        // Données de la base de données (extraites de la base de données ou fournies sous forme d'objet)
        const data = [
            {
                employe_id: '12',
                tache_a_effectuee: 'recuperé des millions',
                appreciation: 17,
                date_de_debut: '2023-10-17',
                date_de_fin: '2023-10-10'
            },
            {
                employe_id: '12',
                tache_a_effectuee: 'azert',
                appreciation: 0, // Mettez à zéro ou une valeur par défaut si non défini
                date_de_debut: '2023-10-17',
                date_de_fin: '2023-10-10'
            },
            {
                employe_id: '7',
                tache_a_effectuee: 'recuperé des millions',
                appreciation: 15,
                date_de_debut: '2023-10-17',
                date_de_fin: '2023-10-04'
            },
            {
                employe_id: '1',
                tache_a_effectuee: 'reussite en cours',
                appreciation: 0, // Mettez à zéro ou une valeur par défaut si non défini
                date_de_debut: '2023-10-17',
                date_de_fin: '2023-10-19'
            }
        ];

        // Structure de données pour le graphique
        const employeeData = {};

        data.forEach(item => {
            const employeId = item.employe_id;
            if (!employeeData[employeId]) {
                employeeData[employeId] = {
                    labels: [],
                    data: [],
                };
            }
            
            // Convertir les dates en objet Date
            const startDate = new Date(item.date_de_debut);
            const endDate = new Date(item.date_de_fin);

            // Calculer la différence en jours
            const daysDiff = Math.ceil((endDate - startDate) / (1000 * 60 * 60 * 24));

            // Répartir l'appréciation sur les jours
            const appreciationPerDay = daysDiff > 0 ? item.appreciation / daysDiff : 0;

            for (let i = 0; i < daysDiff; i++) {
                const date = new Date(startDate);
                date.setDate(startDate.getDate() + i);
                const dateString = date.toISOString().split('T')[0];

                employeeData[employeId].labels.push(dateString);
                employeeData[employeId].data.push(appreciationPerDay);
            }
        });

        // Créer un graphique
        const ctx = document.getElementById('appreciationChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line', // Utiliser un graphique de type ligne
            data: {
                labels: employeeData['12'].labels, // Vous pouvez choisir un employé spécifique ici
                datasets: [{
                    label: 'Appréciation par jour',
                    data: employeeData['12'].data, // Vous pouvez choisir un employé spécifique ici
                    borderColor: 'blue',
                    fill: false
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Appréciation'
                        }
                    }
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>
</html>
