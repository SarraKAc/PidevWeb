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
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\HttpFoundation\JsonResponse;

#[Route('/evenement')]
class EvenementController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_evenement_index', methods: ['GET'])]
    public function index(EvenementRepository $evenementRepository): Response
    {
        $events = $evenementRepository->findAll();

        return $this->render('event.html.twig', [
            'events' => $events,
        ]);
    }

    #[Route('/ghofrane/student-element', name: 'app_student_element')]
    public function studentelement(Request $request): Response
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);

        $currentDate = new \DateTime();
        $form->get('date')->getConfig()->getOptions()['attr']['min'] = $currentDate->format('Y-m-d');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($evenement);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_evenement_index');
        }

        return $this->render('student/student-element.html.twig', [
            'form' => $form->createView(),
            'current_date' => $currentDate,
        ]);
    }

    #[Route('/ghofrane/add-student', name: 'app_add_student')]
    public function addStudent(EvenementRepository $evenementRepository): Response
    {
        $evenements = $evenementRepository->findAll();

        return $this->render('student/add-student.html.twig', [
            'evenements' => $evenements,
        ]);
    }

    #[Route('/{id}', name: 'app_evenement_delete', methods: ['DELETE'])]
    public function delete(Evenement $evenement): Response
    {
        $this->entityManager->remove($evenement);
        $this->entityManager->flush();

        return new Response('L\'événement a été supprimé avec succès.', Response::HTTP_OK);
    }

    #[Route('/evenement/search', name: 'app_evenement_rechercher', methods: ['POST'])]
    public function search(Request $request, EvenementRepository $evenementRepository): JsonResponse
    {
        $searchTerm = $request->request->get('searchTerm');

        if (empty($searchTerm)) {
            $evenements = $evenementRepository->findAll();
        } else {
            $evenements = $evenementRepository->findBySearchTerm($searchTerm);
        }

        $data = [];
        foreach ($evenements as $evenement) {
            $data[] = [
                'id' => $evenement->getId(),
                'nom' => $evenement->getNom(),
                'description' => $evenement->getDescription(),
                'categorie' => $evenement->getCategorie(),
                'prix' => $evenement->getPrix(),
                'date' => $evenement->getDate()->format('Y-m-d'),
            ];
        }

        return new JsonResponse($data);
    }

   

    #[Route('/{id}/edit', name: 'app_evenement_edit', methods: ['GET', 'POST'])]
    public function edit(Evenement $evenement, Request $request): Response
    {
        // Créer le formulaire en utilisant le FormBuilder
        $form = $this->createForm(EvenementType::class, $evenement);

        // Gérer la soumission du formulaire
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrer l'événement
            $this->getDoctrine()->getManager()->flush();

            // Rediriger l'utilisateur vers la page d'accueil des événements
            return $this->redirectToRoute('app_evenement_index');
        }

        // Passer le formulaire à la vue Twig pour l'affichage
        return $this->render('student/add-student.html.twig', [
            'form' => $form->createView(),
            'evenement' => $evenement,
        ]);
    }
    
   
}
