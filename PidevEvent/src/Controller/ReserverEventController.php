<?php

namespace App\Controller;

use App\Entity\ReserverEvent;
use App\Form\ReserverEventType;
use App\Repository\ReserverEventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

        return $this->renderForm('reserver_event/new.html.twig', [
            'reserver_event' => $reserverEvent,
            'form' => $form,
        ]);
    }

    #[Route('/{idReservation}', name: 'app_reserver_event_show', methods: ['GET'])]
    public function show(ReserverEvent $reserverEvent): Response
    {
        return $this->render('reserver_event/show.html.twig', [
            'reserver_event' => $reserverEvent,
        ]);
    }

    #[Route('/{idReservation}/edit', name: 'app_reserver_event_edit', methods: ['GET', 'POST'])]
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

    #[Route('/{idReservation}', name: 'app_reserver_event_delete', methods: ['POST'])]
    public function delete(Request $request, ReserverEvent $reserverEvent, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reserverEvent->getIdReservation(), $request->request->get('_token'))) {
            $entityManager->remove($reserverEvent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reserver_event_index', [], Response::HTTP_SEE_OTHER);
    }
}
