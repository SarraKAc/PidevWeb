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
    #[Route('/', name: 'app_evenement_index', methods: ['GET'])]
    public function index(EvenementRepository $evenementRepository): Response
    {
        return $this->render('event.html.twig', [
            'events' => $evenementRepository->findAll(),
        ]);
        // $events = $this->getDoctrine()->getRepository(Evenement::class)->findAll();


        // // Rendre le template Twig en passant les données des événements
        // return $this->render('event.html.twig', [
        //     'events' => $events,
        // ]);
    }

    
    
  

  
/***********Ajout avec controle de saise sur la date****//////
    #[Route('/ghofrane/student-element', name: 'app_student_element')]
public function studentelement(Request $request, EntityManagerInterface $entityManager): Response
{
    // Création d'une nouvelle instance d'événement
    $evenement = new Evenement();
    $form = $this->createForm(EvenementType::class, $evenement);

    // Récupérer la date actuelle
    $currentDate = new \DateTime();

    // Appliquer la date minimale au champ de formulaire "date"
    $form->get('date')->getConfig()->getOptions()['attr']['min'] = $currentDate->format('Y-m-d');

    $form->handleRequest($request);

    // Vérification de la soumission du formulaire et de la validité des données
    if ($form->isSubmitted() && $form->isValid()) {
       
        // Persistance de l'événement en base de données
        $entityManager->persist($evenement);
        $entityManager->flush();

        // Redirection vers la page d'accueil des événements après la création
        return $this->redirectToRoute('app_student_element');
    }

    // Rendu du formulaire avec la date minimale définie
    return $this->render('student/student-element.html.twig', [
        'form' => $form->createView(),
        'current_date' => $currentDate, // Passer la date actuelle au modèle Twig
    ]);
}


/********************Afficher Evenement ***************** */
   

    #[Route('/ghofrane/add-student', name: 'app_add_student')]
    public function addStudent(EvenementRepository $evenementRepository): Response
    {
    // Récupérer tous les événements depuis la base de données
    $evenements = $evenementRepository->findAll();

    // Passer les événements au template Twig pour affichage
    return $this->render('student/add-student.html.twig', [
        'evenements' => $evenements,
    ]);
}

/*****************supprimer Evenement***********************/
#[Route('/evenement/{id}', name: 'app_evenement_delete', methods: ['DELETE'])]
public function delete(EvenementRepository $evenementRepository, EntityManagerInterface $entityManager, $id): Response
{
    $evenement = $evenementRepository->find($id);
    if (!$evenement) {
        return new Response('L\'événement n\'existe pas.', Response::HTTP_NOT_FOUND);
    }

    $entityManager->remove($evenement);
    $entityManager->flush();

    return new Response('L\'événement a été supprimé avec succès.', Response::HTTP_OK);
}
/***********recherche****************/
#[Route('/evenement/search', name: 'app_evenement_rechercher', methods: ['POST'])]
public function search(Request $request, EvenementRepository $evenementRepository): JsonResponse
{
    // Récupérer le terme de recherche envoyé depuis la requête AJAX
    $searchTerm = $request->request->get('searchTerm');

    // Si le terme de recherche est vide, renvoyer tous les événements
    if (empty($searchTerm)) {
        $evenements = $evenementRepository->findAll();
    } else {
        // Sinon, effectuer une recherche filtrée sur la colonne "nom"
        $evenements = $evenementRepository->findBySearchTerm($searchTerm);
    }

    // Convertir les résultats en un tableau JSON pour la réponse AJAX
    $data = [];
    foreach ($evenements as $evenement) {
        $data[] = [
            'id' => $evenement->getId(),
            'nom' => $evenement->getNom(),
            'description' => $evenement->getDescription(),
            'categorie' => $evenement->getCategorie(),
            'prix' => $evenement->getPrix(),
            'date' => $evenement->getDate()->format('Y-m-d'),
            // Ajoutez d'autres champs que vous souhaitez renvoyer
        ];
    }

    // Renvoyer les résultats au format JSON
    return new JsonResponse($data);
}


   

    #[Route('/{id}/edit', name: 'app_evenement_edit', methods: ['GET', 'POST'])]
    public function edit(Evenement $evenement, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Créer le formulaire en utilisant le FormBuilder
        $form = $this->createForm(EvenementType::class, $evenement);

        // Gérer la soumission du formulaire
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrer l'événement
            $entityManager->flush();
            

            // Rediriger l'utilisateur vers la page d'accueil des événements
            return $this->redirectToRoute('app_evenement_index');
        }

        // Passer le formulaire à la vue Twig pour l'affichage
        return $this->render('student/student-element.html.twig', [
            'form' => $form->createView(),
            'evenements' => $evenement,
        ]);
    }

    
   
}
