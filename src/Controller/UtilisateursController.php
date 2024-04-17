<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Form\UtilisateursType;
use App\Repository\UtilisateursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/utilisateurs')]
class UtilisateursController extends AbstractController
{
    #[Route('/', name: 'app_utilisateurs_index', methods: ['GET'])]
    public function index(UtilisateursRepository $utilisateursRepository): Response
    {
        return $this->render('utilisateurs/index.html.twig', [
            'utilisateurs' => $utilisateursRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_utilisateurs_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $utilisateur = new Utilisateurs();
        $form = $this->createForm(UtilisateursType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($utilisateur);
            $entityManager->flush();

            return $this->redirectToRoute('app_utilisateurs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('utilisateurs/new.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_utilisateurs_show', methods: ['GET'])]
    public function show(Utilisateurs $utilisateur): Response
    {
        return $this->render('utilisateurs/show.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_utilisateurs_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Utilisateurs $utilisateur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UtilisateursType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_utilisateurs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('utilisateurs/edit.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_utilisateurs_delete', methods: ['POST'])]
    public function delete(Request $request, Utilisateurs $utilisateur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$utilisateur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($utilisateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_utilisateurs_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route("/utilisateurs/{id}/editRole", name: "app_utilisateurs_edit_role", methods: ["GET", "POST"])]
    public function editRole(Request $request, Utilisateurs $utilisateur): Response
    {
        // Check if the user exists
        if (!$utilisateur) {
            throw $this->createNotFoundException('User not found');
        }

        // Retrieve user's roles
        $roles = $utilisateur->getRoles();

        // Check if the user has ROLE_USER and ROLE_ADMIN roles
        $hasUserRole = in_array('ROLE_USER', $roles);
        $hasAdminRole = in_array('ROLE_ADMIN', $roles);

        // Logic to update user's role based on the current roles
        if ($hasUserRole && $hasAdminRole) {
            // User has both ROLE_USER and ROLE_ADMIN roles
            // Update user's role to ROLE_USER only
            $utilisateur->setRoles(['ROLE_USER']);
        } else {
            // User has only ROLE_USER role
            // Update user's role to ROLE_ADMIN
            $utilisateur->setRoles(['ROLE_USER','ROLE_ADMIN']);
        }

        // Persist the changes to the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        // Redirect to a success page or return a response
        return $this->redirectToRoute('app_utilisateurs_index');
    }
}
