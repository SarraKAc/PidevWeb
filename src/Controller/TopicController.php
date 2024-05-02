<?php

namespace App\Controller;

use App\Entity\Topic;
use App\Form\TopicType;
use App\Repository\CommentaireRepository;
use App\Repository\TopicRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/topic')]
class TopicController extends AbstractController
{


    #[Route('/sorted', name: 'app_topic_sorted_by_comments', methods: ['GET'])]
    public function sorted(TopicRepository $topicRepository): Response
    {
        $topics = $topicRepository->findTopicsSortedByCommentCount();

        return $this->render('topic/sorted_by_comments.html.twig', [
            'topics' => $topics,
        ]);
    }
    #[Route('/', name: 'app_topic_index', methods: ['GET'])]
    public function index(TopicRepository $topicRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $queryBuilder = $topicRepository->createQueryBuilder('t');

        $pagination = $paginator->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1), /* numéro de la page*/
            6 /* limite par page */
        );

        return $this->render('topic/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

    #[Route('/new', name: 'app_topic_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $topic = new Topic();
        $form = $this->createForm(TopicType::class, $topic);
        $form->handleRequest($request);
$topic->setIdUser(12);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form['image']->getData();
            if ($file) {
                $fileName = uniqid().'.'.$file->guessExtension();
                $file->move($this->getParameter('images_directory'), $fileName);
                $topic->setImage($fileName);
            }
            $currentlydate = new \DateTime('now');
            $topic->setDate($currentlydate);
            $entityManager->persist($topic);
            $entityManager->flush();

            return $this->redirectToRoute('app_topic_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('topic/new.html.twig', [
            'topic' => $topic,
            'form' => $form,
        ]);
    }

    #[Route('/{id_topic}', name: 'app_topic_show', methods: ['GET'])]
    public function show(Topic $topic,CommentaireRepository $commentaireRepository): Response
    {$commentaires=$commentaireRepository->findBy(['id_topic'=>$topic]);
        return $this->render('topic/show.html.twig', [
            'topic' => $topic,'commmentaires'=>$commentaires
        ]);
    }

    #[Route('/{id_topic}/edit', name: 'app_topic_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Topic $topic, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TopicType::class, $topic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_topic_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('topic/edit.html.twig', [
            'topic' => $topic,
            'form' => $form,
        ]);
    }

    #[Route('/{id_topic}', name: 'app_topic_delete', methods: ['POST'])]
    public function delete(Request $request, Topic $topic, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$topic->getId_topic(), $request->request->get('_token'))) {
            $entityManager->remove($topic);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_topic_index', [], Response::HTTP_SEE_OTHER);
    }






}
