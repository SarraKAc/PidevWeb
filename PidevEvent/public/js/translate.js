function translateEvent(nom, description) {
    // Envoie d'une requête AJAX au serveur pour traduire le nom et la description de l'événement
    $.ajax({
        url: '/translate-event', // Endpoint Symfony pour la traduction
        method: 'POST',
        data: {
            eventName: nom,
            eventDescription: description // Inclure la description dans les données de la requête
        },
        success: function(response) {
            alert("Traduction du nom : " + response.translatedName);
            alert("Traduction de la description : " + response.translatedDescription); // Afficher la traduction de la description dans une alerte
        },
        error: function(xhr, status, error) {
            console.error('Erreur lors de la traduction de l\'événement : ' + error);
        }
    });
}
