/*
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
}*/
translate.js

/*function translateEvent(eventName) {
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
}*/



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

