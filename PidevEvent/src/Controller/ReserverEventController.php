<?php

namespace App\Controller;
use Psr\Log\LoggerInterface;
use App\Entity\ReserverEvent;
use App\Entity\Evenement;
use App\Form\ReserverEventType;
use App\Repository\ReserverEventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;






#[Route('/reserver/event')]
class ReserverEventController extends AbstractController
{
    #[Route('/', name: 'app_reserver_event_index', methods: ['GET'])]
    public function index(ReserverEventRepository $reserverEventRepository): Response
    {
        return $this->render('reserver_event/index.html.twig', [
            'reserver_events' => $reserverEventRepository->findAll(),
        ]);
    }

    


   
    /***********************ajout du back */
        #[Route('/new', name: 'app_reserver_event_new', methods: ['GET', 'POST'])]
        public function new(Request $request, EntityManagerInterface $entityManager): Response
        {
            $reserverEvent = new ReserverEvent();
            // Obtention de la date et de l'heure actuelles
            $now = new \DateTime();
            $reserverEvent->setDateReservation($now);
    
            $form = $this->createForm(ReserverEventType::class, $reserverEvent);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager->persist($reserverEvent);
                $entityManager->flush();
    
                return $this->redirectToRoute('app_reserver_event_new', [], Response::HTTP_SEE_OTHER);
            }
    
            return $this->renderForm('student/reserver-event.html.twig', [
                'reserver_event' => $reserverEvent,
                'form' => $form,
            ]);
        }



















    /*#[Route('/reservations/new', name: 'reservation_new', methods: ['POST'])]
    public function create(Request $request): Response
    {
        // Récupérer les données du formulaire
        $nom = $request->request->get('nom');
        $nbr_personne = $request->request->get('nbr_personne');
        $date_reservation = new \DateTime($request->request->get('date_reservation'));
        $email = $request->request->get('email');
        $id_evenement = $request->request->get('id_evenement'); // Assurez-vous de récupérer l'identifiant de l'événement
    
        // Vérifier si l'identifiant de l'événement est présent
        if (!$id_evenement) {
            // Gérer le cas où l'identifiant de l'événement est manquant
            return new Response('L\'identifiant de l\'événement est manquant.', Response::HTTP_BAD_REQUEST);
        }
    
        // Récupérer l'événement associé à l'identifiant
        $evenement = $this->getDoctrine()->getRepository(Evenement::class)->find($id_evenement);
    
        // Vérifier si l'événement existe
        if (!$evenement) {
            // Gérer le cas où l'événement n'existe pas
            return new Response('L\'événement associé à l\'identifiant n\'existe pas.', Response::HTTP_NOT_FOUND);
        }
    
        // Créer une nouvelle instance de ReserverEvent
        $reserverEvent = new ReserverEvent();
        $reserverEvent->setNom($nom);
        $reserverEvent->setNbrPersonne($nbr_personne);
        $reserverEvent->setDateReservation($date_reservation);
        $reserverEvent->setEmail($email);
        $reserverEvent->setEvenement($evenement); // Définir l'événement associé à la réservation
    
        // Enregistrer la nouvelle réservation
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($reserverEvent);
        $entityManager->flush();
    
        // Rediriger ou retourner une réponse appropriée
        return new Response('La réservation a été créée avec succès.', Response::HTTP_CREATED);
    }*/
    


    
    /**********************ajouter reservation front **********************/
    /*#[Route('/reservations/new', name: 'reservation_new', methods: ['POST'])]
    public function create(Request $request): Response
    {
        // Récupérer les données du formulaire
        $nom = $request->request->get('nom');
        $nbr_personne = $request->request->get('nbr_personne');
        $date_reservation = new \DateTime($request->request->get('date_reservation'));
        $email = $request->request->get('email');
        $id_evenement = $request->request->get('id_evenement'); // Assurez-vous de récupérer l'identifiant de l'événement
    
        // Vérifier si l'identifiant de l'événement est présent
        if (!$id_evenement) {
            // Gérer le cas où l'identifiant de l'événement est manquant
            return new Response('L\'identifiant de l\'événement est manquant.', Response::HTTP_BAD_REQUEST);
        }
    
        // Récupérer l'événement associé à l'identifiant
        $evenement = $this->getDoctrine()->getRepository(Evenement::class)->find($id_evenement);
    
        // Vérifier si l'événement existe
        if (!$evenement) {
            // Gérer le cas où l'événement n'existe pas
            return new Response('L\'événement associé à l\'identifiant n\'existe pas.', Response::HTTP_NOT_FOUND);
        }
    
        // Créer une nouvelle instance de ReserverEvent
        $reserverEvent = new ReserverEvent();
        $reserverEvent->setNom($nom);
        $reserverEvent->setNbrPersonne($nbr_personne);
        $reserverEvent->setDateReservation($date_reservation);
        $reserverEvent->setEmail($email);
        $reserverEvent->setEvenement($evenement); // Définir l'événement associé à la réservation
    
        // Enregistrer la nouvelle réservation
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($reserverEvent);
        $entityManager->flush();
    
        // Rediriger vers la page d'affichage des événements
        return $this->redirectToRoute('app_events');
    }*/
    
    
    





















    #[Route('/reservations/new', name: 'reservation_new', methods: ['POST'])]
    public function create(Request $request): Response
    {
        // Récupérer les données du formulaire
        $nom = $request->request->get('nom');
        $nbr_personne = $request->request->get('nbr_personne');
        
        // Créer une nouvelle instance de DateTime pour la date et l'heure actuelles
        $date_reservation = new \DateTime();
        
        // Récupérer l'heure actuelle au format heure:minute
        $heure_minute = $date_reservation->format('H:i');
    
        // Mettre à jour la date de réservation avec l'heure et les minutes actuelles
        $date_reservation->setTime(date('H'), date('i'));
        
        $email = $request->request->get('email');
        $id_evenement = $request->request->get('id_evenement'); // Assurez-vous de récupérer l'identifiant de l'événement
    
        // Vérifier si l'identifiant de l'événement est présent
        if (!$id_evenement) {
            // Gérer le cas où l'identifiant de l'événement est manquant
            return new Response('L\'identifiant de l\'événement est manquant.', Response::HTTP_BAD_REQUEST);
        }
    
        // Récupérer l'événement associé à l'identifiant
        $evenement = $this->getDoctrine()->getRepository(Evenement::class)->find($id_evenement);
    
        // Vérifier si l'événement existe
        if (!$evenement) {
            // Gérer le cas où l'événement n'existe pas
            return new Response('L\'événement associé à l\'identifiant n\'existe pas.', Response::HTTP_NOT_FOUND);
        }
    
        // Créer une nouvelle instance de ReserverEvent
        $reserverEvent = new ReserverEvent();
        $reserverEvent->setNom($nom);
        $reserverEvent->setNbrPersonne($nbr_personne);
        $reserverEvent->setDateReservation($date_reservation); // Utiliser la date, l'heure et les minutes actuelles
        $reserverEvent->setEmail($email);
        $reserverEvent->setEvenement($evenement); // Définir l'événement associé à la réservation
    
        // Enregistrer la nouvelle réservation
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($reserverEvent);
        $entityManager->flush();
    
        // Rediriger vers la page d'affichage des événements
        return $this->redirectToRoute('app_events');
    }
    




    // #[Route('/afficher', name: 'app_afficher_reservation', methods: ['GET'])]
    // public function show(ReserverEvent $reserverEvent): Response
    // {
    //     return $this->render('student/afficher-reservation.html.twig', [
    //         'reserver_event' => $reserverEvent,
    //     ]);
    // }

    /****************************************afficher dans tabl */
    #[Route('/afficher', name: 'app_afficher_reservation', methods: ['GET'])]
    public function show(): Response
    {
        $reservations = $this->getDoctrine()->getRepository(ReserverEvent::class)->findAll();

        return $this->render('student/afficher-reservation.html.twig', [
            'reservations' => $reservations,
        ]);
    }





    #[Route('/new-reservation', name: 'add_reservation', methods: ['GET', 'POST'])]
    public function addReservation(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reserverEvent = new ReserverEvent();
        $form = $this->createForm(ReserverEventType::class, $reserverEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reserverEvent);
            $entityManager->flush();

            return $this->redirectToRoute('app_reserver_event_index', [], Response::HTTP_SEE_OTHER);
        }

        $events = $this->getDoctrine()->getRepository(Evenement::class)->findAll();

        return $this->render('event.html.twig', [
            'events' => $events,
        ]);
    }








    #[Route('/{id_reservation}/edit', name: 'app_reserver_event_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReserverEvent $reserverEvent, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReserverEventType::class, $reserverEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reserver_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reserver_event/edit.html.twig', [
            'reserver_event' => $reserverEvent,
            'form' => $form,
        ]);
    }










    /***********************supprimerrrrr */
    #[Route('/{id_reservation}', name: 'app_reserver_event_delete', methods: ['POST'])]
    public function delete(ReserverEvent $reserverEvent, EntityManagerInterface $entityManager): Response
{
    if (!$reserverEvent) {
        return new Response('La réservation n\'existe pas.', Response::HTTP_NOT_FOUND);
    }

    $entityManager->remove($reserverEvent);
    $entityManager->flush();

    
    return $this->redirectToRoute('app_afficher_reservation');
}
}
