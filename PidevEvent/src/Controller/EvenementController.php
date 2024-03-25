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
        return $this->redirectToRoute('app_evenement_index');
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



   




    #[Route('/{id}/edit', name: 'app_evenement_edit', methods: ['GET', 'POST'])]
    public function edit(EvenementRepository $evenementRepository, $id, Request $request): Response
{
    // Récupérer l'événement à éditer
    $evenement = $evenementRepository->find($id);

    // Créer le formulaire en utilisant le FormBuilder
    $form = $this->createForm(EvenementType::class, $evenement);

    // Gérer la soumission du formulaire
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        // Traiter les données du formulaire et enregistrer l'événement
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($evenement);
        $entityManager->flush();

        // Rediriger l'utilisateur vers une autre page par exemple
        // return $this->redirectToRoute('http://127.0.0.1:8000/evenement/ghofrane/add-student');
    }

    // Passer le formulaire à la vue Twig pour l'affichage
    return $this->render('student/add-student.html.twig', [
        'form' => $form->createView(),
        'evenement' => $evenement, // Vous pouvez également passer l'événement pour initialiser les données dans les balises HTML
    ]);
}

    
    

    /*#[Route('/{id}', name: 'app_evenement_delete', methods: ['POST'])]
    public function delete(Request $request, Evenement $evenement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$evenement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($evenement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_evenement_index', [], Response::HTTP_SEE_OTHER);
    }*/













/***********Ajout sans controle de saise sur la date****//////
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
        return $this->render('student/student-element.html.twig', [
            'form' => $form->createView(),
        ]);
    }*/
}
