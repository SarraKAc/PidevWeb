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

    #[Route('/new', name: 'app_reserver_event_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reserverEvent = new ReserverEvent();
        $form = $this->createForm(ReserverEventType::class, $reserverEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reserverEvent);
            $entityManager->flush();

            return $this->redirectToRoute('app_reserver_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('student/reserver-event.html.twig', [
            'reserver_event' => $reserverEvent,
            'form' => $form,
        ]);
    }


    // #[Route('/new', name: 'app_reserver_event_new', methods: ['POST'])]
    // public function new(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     // Récupérez les événements depuis la base de données
    //     $events = $this->getDoctrine()->getRepository(Evenement::class)->findAll();
    
    //     $reserverEvent = new ReserverEvent();
    //     $form = $this->createForm(ReserverEventType::class, $reserverEvent);
    //     $form->handleRequest($request);
    
    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $reserverEvent = $form->getData();
    
    //         $entityManager->persist($reserverEvent);
    //         $entityManager->flush();
    
    //         return $this->redirectToRoute('app_reserver_event_index');
    //     }
    
    //     return $this->render('event.html.twig', [
    //         'reserver_event' => $reserverEvent,
    //         'events' => $events, // Passer les événements à la vue Twig
    //         'form' => $form->createView(),
    //     ]);
    // }
    
    
   

   

    
    
    
    




    // #[Route('/afficher', name: 'app_afficher_reservation', methods: ['GET'])]
    // public function show(ReserverEvent $reserverEvent): Response
    // {
    //     return $this->render('student/afficher-reservation.html.twig', [
    //         'reserver_event' => $reserverEvent,
    //     ]);
    // }
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

    #[Route('/{id_reservation}', name: 'app_reserver_event_delete', methods: ['POST'])]
    public function delete(Request $request, ReserverEvent $reserverEvent, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reserverEvent->getId_reservation(), $request->request->get('_token'))) {
            $entityManager->remove($reserverEvent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reserver_event_index', [], Response::HTTP_SEE_OTHER);
    }
}
