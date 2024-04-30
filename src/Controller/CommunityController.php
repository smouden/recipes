<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Topic;
use App\Repository\TopicRepository;
use App\Repository\PostRepository;



class CommunityController extends AbstractController
{
    #[Route('/community', name: 'app_community')]
    public function index(TopicRepository $topicRepository): Response
    {
        $topics = $topicRepository->findAll(); // Récupère tous les topics

        return $this->render('community/index.html.twig', [
            'topics' => $topics,
        ]);
    }

    #[Route('/community/{id}', name: 'app_topic')]
    public function showTopic($id, TopicRepository $topicRepository, PostRepository $postRepository): Response
    {
        $topic = $topicRepository->find($id); // Récupère le topic par son ID
        $posts = $postRepository->findBy(['topic' => $topic]); // Récupère les posts associés à ce topic

        return $this->render('community/post.html.twig', [
            'topic' => $topic,
            'posts' => $posts,
        ]);
    }

}
