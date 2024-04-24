<?php

namespace App\Controller;
use App\Entity\Avis;
use App\Form\AvisType;
use App\Entity\Service;
use App\Form\ServiceType;

use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/service')]
class ServiceController extends AbstractController
{ public ServiceRepository $ServiceRepository;
    public $entityManager;

    public function __construct(ServiceRepository $ServiceRepository)
    {
        $this->ServiceRepository = $ServiceRepository;
    }



    #[Route('/', name: 'app_service_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager,ServiceRepository $sr): Response
    {
        $services = $entityManager
            ->getRepository(Service::class)
            ->findAll();

        return $this->render('service/index.html.twig', [
            'services' => $services,
            'sr'=> $sr
        ]);
    }
//    #[Route('/service/search', name: 'app_service_rechercher', methods: ['POST'])]
//    public function search(Request $request, ServiceRepository $serviceRepository): JsonResponse
//    {
//        // Récupérer le terme de recherche envoyé depuis la requête AJAX
//        $searchTerm = $request->request->get('searchTerm');
//
//        // Si le terme de recherche est vide, renvoyer tous les événements
//        if (empty($searchTerm)) {
//            $services = $serviceRepository->findAll();
//        } else {
//            // Sinon, effectuer une recherche filtrée sur la colonne "nom"
//            $services = $serviceRepository->findBySearchTerm($searchTerm);
//        }

//        // Convertir les résultats en un tableau JSON pour la réponse AJAX
//        $data = [];
//        foreach ($services as $service) {
//            $data[] = [
//
//                'nom' => $service->getNomService(),
//                'Titre' => $service->getTitreService(),
//                'Domaine' => $service->getDomaine(),
//                'prix' => $service->getPrix(),
//                'duree' => $service->getDomaine(),
//                // Ajoutez d'autres champs que vous souhaitez renvoyer
//            ];
//        }
//
//        // Renvoyer les résultats au format JSON
//        return new JsonResponse($data);
//    }

    #[Route('/newA', name: 'app_avis_new', methods: ['GET', 'POST'])]
    public function newA(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avis = new Avis();
        $form = $this->createForm(AvisType::class, $avis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($avis);
            $entityManager->flush();

            return $this->redirectToRoute('app_avis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('avis/new.html.twig', [
            'avis' => $avis,
            'form' => $form,
        ]);
    }

    #[Route('/{idService}/newA2', name: 'app_avis_new2', methods: ['GET', 'POST'])]
    public function newA2(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avis = new Avis();
        $form = $this->createForm(AvisType::class, $avis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($avis);
            $entityManager->flush();

            return $this->redirectToRoute('app_avis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('avis/new2.html.twig', [
            'avis' => $avis,
            'form' => $form,
        ]);
    }
    #[Route('/new', name: 'app_service_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('img')->getData();
            if ($file) {
                $fileName = md5(uniqid()).'.'.$file->guessExtension();
                $file->move(
                    $this->getParameter('upload_directory'),
                    $fileName
                );
                $service->setImg($fileName);
            }
            $entityManager->persist($service);
            $entityManager->flush();

            return $this->redirectToRoute('app_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('service/new.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }


    #[Route('/{idService}', name: 'app_service_show', methods: ['GET'])]
    public function show(Service $service): Response
    {
        return $this->render('service/show.html.twig', [
            'service' => $service,
        ]);
    }

    #[Route('/{idService}/edit', name: 'app_service_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Service $service, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('service/edit.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }

    #[Route('/{idService}', name: 'app_service_delete', methods: ['POST'])]
    public function delete(Request $request, Service $service, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$service->getIdService(), $request->request->get('_token'))) {
            $entityManager->remove($service);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_service_index', [], Response::HTTP_SEE_OTHER);
    }






}
