<?php

namespace App\Controller;

use App\Entity\Ressource;
use App\Entity\Utilisateur;
use App\Form\Ressource2Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ressource')]
class RessourceabcController extends AbstractController
{
    #[Route('/', name: 'app_ressourceabc_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $ressources = $entityManager
            ->getRepository(Ressource::class)
            ->findAll();

        return $this->render('ressourceabc/index.html.twig', [
            'ressources' => $ressources,
        ]);
    }

    #[Route('/new', name: 'app_ressourceabc_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ressource = new Ressource();
        $form = $this->createForm(Ressource2Type::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateurId = $form->get('utilisateur')->getData();
            $utilisateur = $entityManager->getRepository(Utilisateur::class)->find($utilisateurId);

            $ressource->setUtilisateur($utilisateur);

            $entityManager->persist($ressource);
            $entityManager->flush();

            return $this->redirectToRoute('app_ressourceabc_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ressourceabc/new.html.twig', [
            'ressource' => $ressource,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ressourceabc_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ressource $ressource, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Ressource2Type::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $utilisateurId = $form->get('utilisateur')->getData();
            $utilisateur = $entityManager->getRepository(Utilisateur::class)->find($utilisateurId);

            $ressource->setUtilisateur($utilisateur);

            $entityManager->flush();

            return $this->redirectToRoute('app_ressourceabc_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ressourceabc/edit.html.twig', [
            'ressource' => $ressource,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_ressourceabc_show', methods: ['GET'])]
    public function show(Ressource $ressource): Response
    {
        return $this->render('ressourceabc/show.html.twig', [
            'ressource' => $ressource,
        ]);
    }



    #[Route('/{id}', name: 'app_ressourceabc_delete', methods: ['POST'])]
    public function delete(Request $request, Ressource $ressource, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ressource->getId(), $request->request->get('_token'))) {
            $entityManager->remove($ressource);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_ressourceabc_index', [], Response::HTTP_SEE_OTHER);
    }
}
