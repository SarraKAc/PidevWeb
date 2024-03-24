<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/evenement')]
class EvenementController extends AbstractController
{
    #[Route('/', name: 'app_evenement_index', methods: ['GET'])]
    public function index(EvenementRepository $evenementRepository): Response
    {
        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenementRepository->findAll(),
        ]);
    }

    /*#[Route('/new', name: 'app_evenement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($evenement);
            $entityManager->flush();

            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evenement/new.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);


        
    }*/
    /*#[Route('/ghofrane/student-element', name: 'app_student_element')]
    public function studentelement(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Création d'une nouvelle instance d'événement
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);
    
        // Vérification de la soumission du formulaire et de la validité des données
        if ($form->isSubmitted() && $form->isValid()) {
            // Persistance de l'événement en base de données
            $entityManager->persist($evenement);
            $entityManager->flush();
    
            // Redirection vers la page d'accueil des événements après la création
            return $this->redirectToRoute('app_evenement_index');
        }
    
        // Rendu du même template que la première fonction, mais avec le formulaire créé dans cette fonction
        return $this->render('evenement/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }*/
    #[Route('/ghofrane/student-element', name: 'app_student_element')]
    public function studentelement(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Création d'une nouvelle instance d'événement
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);
    
        // Vérification de la soumission du formulaire et de la validité des données
        if ($form->isSubmitted() && $form->isValid()) {
            // Persistance de l'événement en base de données
            $entityManager->persist($evenement);
            $entityManager->flush();
    
            // Redirection vers la page d'accueil des événements après la création
            return $this->redirectToRoute('app_evenement_index');
        }
    
        // Rendu du même template que la première fonction, mais avec le formulaire créé dans cette fonction
        return $this->render('student/student-element.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/{id}', name: 'app_evenement_show', methods: ['GET'])]
    public function show(Evenement $evenement): Response
    {
        return $this->render('evenement/show.html.twig', [
            'evenement' => $evenement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_evenement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('evenement/edit.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_evenement_delete', methods: ['POST'])]
    public function delete(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($evenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
    }
}
