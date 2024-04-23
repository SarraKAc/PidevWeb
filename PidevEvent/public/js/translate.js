
function translate(eventName) {
    
    // Envoie d'une requête AJAX au serveur pour traduire l'événement
    $.ajax({
        url: '/translate-event', // L'URL de votre endpoint Symfony pour la traduction
        method: 'POST',
        data: {
            eventName: eventName
        },
        success: function (response) {
            alert("Traduction : " + response.translatedContent); // Afficher la traduction dans une alerte (vous pouvez modifier cette partie pour mettre à jour le contenu de la page)
        },
        error: function (xhr, status, error) {
            console.error('Erreur lors de la traduction de l\'événement : ' + error);
        }
    });
}
