<?php


namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Evenement;
use App\Entity\Service;
use App\Form\AvisType;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\AvisRepository;

class PreviewController extends AbstractController
{
    #[Route('/integration', name: 'app_integration')]
    public function index(): Response
    {
        return $this->render('front-office.html.twig');
    }

    #[Route('/events', name: 'app_events')]
    public function events(): Response
    {
        // Récupérer les données des événements depuis la base de données
        $events = $this->getDoctrine()->getRepository(Evenement::class)->findAll();

        // Rendre le template Twig en passant les données des événements
        return $this->render('event.html.twig', [
            'events' => $events,
        ]);
    }
    #[Route('/services', name: 'app_services')]
    public function services(PaginatorInterface $paginator, Request $request): Response
    {
        // Récupérer les données des événements depuis la base de données
        $servicesQuery = $this->getDoctrine()->getRepository(Service::class)->findAll();
        $avi = $this->getDoctrine()->getRepository(Avis::class)->findAll();
        // Rendre le template Twig en passant les données des services
        // Paginer les résultats
        $services = $paginator->paginate(
            $servicesQuery, // Requête à paginer
            $request->query->getInt('page', 1), // Numéro de page par défaut
            6 // Nombre d'éléments par page
        );
        return $this->render('service.html.twig', [
            'services' => $services,'aviss'=>$avi,
        ]);
    }
    #[Route('/ghofrane', name: 'app_ghofrane')]
    public function ghofrane(): Response
    {
        return $this->render('back-office.html.twig');
    }
    #[Route('/stat', name: 'app_service_Statistique', methods: ['GET'])]
    public function statique(ServiceRepository $sr): Response
    {$services = new Service();
        return $this->render('statistique.html.twig',
        ['sr' =>$sr, 'services' =>$services ]);
    }
    #[Route('services/{idService}', name: 'app_serviceF_show', methods: ['GET'])]
    public function showF(Service $service): Response
    {
        return $this->render('service/showF.html.twig', [
            'service' => $service,
        ]);
    }
    #[Route('/newAF', name: 'app_avisF_new', methods: ['GET', 'POST'])]
    public function newAF(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avis = new Avis();
        $form = $this->createForm(AvisType::class, $avis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($avis);
            $entityManager->flush();

            return $this->redirectToRoute('app_services', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('avis/newAF.html.twig', [
            'avis' => $avis,
            'form' => $form,
        ]);
    }
    #[Route('/newSF', name: 'app_serviceF_new', methods: ['GET', 'POST'])]
    public function newSF(Request $request, EntityManagerInterface $entityManager): Response
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

            return $this->redirectToRoute('app_services', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('service/newFront.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }
    /**
     * @Route("/services-avis", name="services_avis")
     */
    public function servicesAvis()
    {
        $services = $this->getDoctrine()->getRepository(Service::class)->findAll();
        $data = [];

        foreach ($services as $service) {
            $nombreAvis = count($service->getAvis());
            $totalEtoiles = 0;

            foreach ($service->getAvis() as $avis) {
                $totalEtoiles += $avis->getNbrEtoile();
            }

            $moyenneEtoiles = $nombreAvis > 0 ? $totalEtoiles / $nombreAvis : 0;

            $data[] = [
                'nom' => $service->getNomService(),
                'moyenne' => $moyenneEtoiles
            ];
        }

        return new JsonResponse($data);
    }

    /**
     * @Route("/services", name="liste_service")
     */
    public function ListeService(): Response
    {
        // Récupérer tous les services depuis la base de données
        $entityManager = $this->getDoctrine()->getManager();
        $services = $entityManager->getRepository(Service::class)->findAll();

        // Calculer les moyennes des avis et trier les services par moyenne
        $servicesTriees = $this->trierServicesParMoyenne($services);

        // Rendre la vue Twig avec les services triés
        return $this->render('/service.html.twig', [
            'servicesTriees' => $servicesTriees,
        ]);
    }


    // Méthode pour trier les services par moyenne des avis
    private function trierServicesParMoyenne($services)
    {
        // Fonction de comparaison pour trier les services par moyenne des avis
        $comparer = function ($serviceA, $serviceB) {
            $moyenneA = $serviceA->getMoyenneAvis();
            $moyenneB = $serviceB->getMoyenneAvis();

            if ($moyenneA == $moyenneB) {
                return 0;
            }
            return ($moyenneA < $moyenneB) ? 1 : -1;
        };

        // Tri des services en utilisant la fonction de comparaison
        usort($services, $comparer);

        // Retourner les services triés
        return $services;
    }


//    #[Route('services/newFront', name: 'app_serviceF_new', methods: ['GET', 'POST'])]
//    public function newFront(Request $request, EntityManagerInterface $entityManager): Response
//    {
//        $service = new Service();
//        $form = $this->createForm(ServiceType::class, $service);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $file = $form->get('img')->getData();
//            if ($file) {
//                $fileName = md5(uniqid()).'.'.$file->guessExtension();
//                $file->move(
//                    $this->getParameter('upload_directory'),
//                    $fileName
//                );
//                $service->setImg($fileName);
//            }
//            $entityManager->persist($service);
//            $entityManager->flush();
//
//            return $this->redirectToRoute('app_service_index', [], Response::HTTP_SEE_OTHER);
//        }
//
//        return $this->renderForm('service/newFront.html.twig', [
//            'service' => $service,
//            'form' => $form,
//        ]);
//    }


    /*#[Route('/ghofrane/student-element', name: 'app_student_element')]
    public function studentelement(): Response
    {
        // Votre logique pour la page add-student, par exemple, rendu d'un modèle Twig
        return $this->render('student/student-element.html.twig');
    }*/

}