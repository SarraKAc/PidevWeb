<?php

// Connexion à la base de données
$con = mysqli_connect("localhost", "root", "", "pi");

// Vérification de la connexion
if (!$con) {
    echo "Connexion échouée : " . mysqli_connect_error();
    exit(); // Arrête le script si la connexion échoue
}

// Requête SQL pour récupérer les noms des services et les moyennes d'avis
$sql = "SELECT service.nom_service, COUNT(avis.nbr_etoile) AS nombre_avis 
        FROM service 
        INNER JOIN avis ON service.id_service = avis.id_service 
        GROUP BY service.nom_service";

// Exécution de la requête SQL
$req = mysqli_query($con, $sql);

// Initialisation des tableaux pour stocker les données
$noms = [];
$moyennes = [];

// Parcours des résultats de la requête et stockage des données dans les tableaux
while ($data = mysqli_fetch_assoc($req)) {
    $noms[] = $data['nom_service'];
    // Conversion de la moyenne en nombre flottant
    $moyennes[] = floatval($data['nombre_avis']);
}

// Fermeture de la connexion à la base de données
mysqli_close($con);

?>

<script>
    const ctx = document.getElementById('myPieChart');

    new Chart(ctx, {
        type: 'doughnut', // Changer le type de graphique en donut
        data: {
            labels: <?php echo json_encode($noms) ?>,
            datasets: [{
                label: '# Moyennes des Services',
                data: <?php echo json_encode($moyennes) ?>,
                backgroundColor: [
                    '#0074D9', , '#7FDBFF', '#19A974', '#3D9970',
                     '#3D9970', '#7FDBFF', '#39CCCC', '#3D9970',
                    '#0052CC', '#2ECC40', '#7FDBFF', '#01FF70', '#3D9970',
                    '#004085', '#7FDBFF', '#3D9970',// Couleur de remplissage pour la troisième tranche
                    // Ajoutez d'autres couleurs de remplissage au besoin
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
