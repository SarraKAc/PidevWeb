
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


    alert("Traduction de : " + nom);
}
translate.js

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

// translate.js

// function translateEvent(eventName, eventDescription, eventCategory, eventDate) {
//     // Envoie d'une requête AJAX au serveur pour traduire l'événement
//     $.ajax({
//         url: '/translate-event', // Endpoint Symfony pour la traduction
//         method: 'POST',
//         data: { 
//             eventName: eventName,
//             eventDescription: eventDescription,
//             eventCategory: eventCategory,
//             eventDate: eventDate
//         },
//         success: function(response) {
//             // Vérifier si les champs traduits sont définis dans la réponse
//             if (response.translatedName && response.translatedDescription && response.translatedCategory && response.translatedDate) {
//                 // Afficher la traduction des différents champs de l'événement
//                 alert("Traduction du nom : " + response.translatedName);
//                 alert("Traduction de la description : " + response.translatedDescription);
//                 alert("Traduction de la catégorie : " + response.translatedCategory);
//                 alert("Traduction de la date : " + response.translatedDate);
//             } else {
//                 console.error('Erreur : Les champs traduits sont manquants dans la réponse.');
//             }
//         },
//         error: function(xhr, status, error) {
//             console.error('Erreur lors de la traduction de l\'événement : ' + error);
//         }
//     });
// }


