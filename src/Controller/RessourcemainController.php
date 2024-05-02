<?php

namespace App\Controller;

use App\Entity\Ressource;
use App\Form\Ressource1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ressourcemain')]
class RessourcemainController extends AbstractController
{
    #[Route('/', name: 'app_ressourcemain_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $ressources = $entityManager
            ->getRepository(Ressource::class)
            ->findAll();

        return $this->render('ressourcemain/index.html.twig', [
            'ressources' => $ressources,
        ]);
    }

    #[Route('/new', name: 'app_ressourcemain_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ressource = new Ressource();
        $form = $this->createForm(Ressource1Type::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ressource);
            $entityManager->flush();

            return $this->redirectToRoute('app_ressourcemain_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ressourcemain/new.html.twig', [
            'ressource' => $ressource,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ressourcemain_show', methods: ['GET'])]
    public function show(Ressource $ressource): Response
    {
        return $this->render('ressourcemain/show.html.twig', [
            'ressource' => $ressource,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ressourcemain_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ressource $ressource, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Ressource1Type::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_ressourcemain_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ressourcemain/edit.html.twig', [
            'ressource' => $ressource,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ressourcemain_delete', methods: ['POST'])]
    public function delete(Request $request, Ressource $ressource, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ressource->getId(), $request->request->get('_token'))) {
            $entityManager->remove($ressource);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_ressourcemain_index', [], Response::HTTP_SEE_OTHER);
    }
}
