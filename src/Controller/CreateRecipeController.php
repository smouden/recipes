<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateRecipeController extends AbstractController
{
    #[Route('/CreateRecipe', name: 'app_create_recipe')]
    public function index(): Response
    {
        return $this->render('create_recipe/index.html.twig', [
            'controller_name' => 'CreateRecipeController',
        ]);
    }
}
