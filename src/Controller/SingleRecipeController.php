<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SingleRecipeController extends AbstractController
{
    #[Route('/single-recipe', name: 'app_single_recipe')]
    public function index(): Response
    {
        return $this->render('single_recipe/index.html.twig', [
            'controller_name' => 'SingleRecipeController',
        ]);
    }
}
