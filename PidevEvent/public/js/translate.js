// // translate.js

// function translateEvent(eventName) {
//     // Envoie d'une requête AJAX au serveur pour traduire l'événement
//     $.ajax({
//         url: '/translate-event', // Endpoint Symfony pour la traduction
//         method: 'POST',
//         data: { eventName: eventName },
//         success: function(response) {
//             alert("Traduction : " + response.translatedContent); // Afficher la traduction
//         },
//         error: function(xhr, status, error) {
//             console.error('Erreur lors de la traduction de l\'événement : ' + error);
//         }
//     });
// }

// Fonction pour traduire le nom de l'événement
function translateEvent(eventName) {
    // Envoie d'une requête AJAX au serveur pour traduire l'événement
    $.ajax({
        url: '/translate-event', // Endpoint Symfony pour la traduction
        method: 'POST',
        data: { eventName: eventName },
        success: function(response) {
            alert("Traduction : " + response.translatedContent); // Afficher la traduction
        },
        error: function(xhr, status, error) {
            console.error('Erreur lors de la traduction de l\'événement : ' + error);
        }
    });
}
