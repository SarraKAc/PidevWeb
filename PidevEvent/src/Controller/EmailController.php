<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailController extends AbstractController
{
    public function sendEmail(MailerInterface $mailer)
    {
        // Créez un objet Email avec les détails de votre e-mail
        $email = (new Email())
            ->from('aissaghofrane1@example.com') // L'adresse e-mail de l'expéditeur
            ->to('recipient@example.com') // L'adresse e-mail du destinataire
            ->subject('Sujet de l\'e-mail') // Le sujet de l'e-mail
            ->text('Contenu du message en texte brut.') // Le contenu du message en texte brut
            ->html('<p>Contenu du message en HTML.</p>'); // Le contenu du message en HTML

        // Utilisez le service MailerInterface pour envoyer l'e-mail
        $mailer->send($email);

        // Vous pouvez également gérer les erreurs d'envoi d'e-mail ici
    }
}
