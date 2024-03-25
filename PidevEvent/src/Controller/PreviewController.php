<?php

namespace App\Controller;
use App\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\EvenementRepository;
class PreviewController extends AbstractController
{
    #[Route('/integration', name: 'app_integration')]
    public function index(): Response
    {
        return $this->render('front-office.html.twig');
    }

    #[Route('/events', name: 'app_events')]
    public function events(): Response
    {
        // Récupérer les données des événements depuis la base de données
        $events = $this->getDoctrine()->getRepository(Evenement::class)->findAll();

        // Rendre le template Twig en passant les données des événements
        return $this->render('event.html.twig', [
            'events' => $events,
        ]);
    }
   
    #[Route('/ghofrane', name: 'app_ghofrane')]
    public function ghofrane(): Response
    {
        return $this->render('back-office.html.twig');
    }
    /*#[Route('/ghofrane/add-student', name: 'app_add_student')]
    public function addStudent(): Response
    {
        // Votre logique pour la page add-student, par exemple, rendu d'un modèle Twig
        return $this->render('student/add-student.html.twig');
    }*/
    
    /*#[Route('/ghofrane/student-element', name: 'app_student_element')]
    public function studentelement(): Response
    {
        // Votre logique pour la page add-student, par exemple, rendu d'un modèle Twig
        return $this->render('student/student-element.html.twig');
    }*/
   
}
