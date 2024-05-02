<?php

// Connexion à la base de données
$con = mysqli_connect("localhost", "root", "", "pi");

// Vérification de la connexion
if (!$con) {
    echo "Connexion échouée : " . mysqli_connect_error();
    exit(); // Arrête le script si la connexion échoue
}

// Requête SQL pour récupérer les noms des services et les moyennes d'avis
$sql = "SELECT service.nom_service, COUNT(avis.nbr_etoile) AS nombreAvis 
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
    $moyennes[] = floatval($data['moyenne_avis']);
}

// Fermeture de la connexion à la base de données
mysqli_close($con);

?>
<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($noms) ?>,
            datasets: [{
                label: '# Moyennes des Services',
                data: <?php echo json_encode($moyennes) ?>,
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
