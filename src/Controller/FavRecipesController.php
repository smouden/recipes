<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavRecipesController extends AbstractController
{
    #[Route('/FavRecipes', name: 'app_fav_recipes')]
    public function index(): Response
    {
        return $this->render('fav_recipes/index.html.twig', [
            'controller_name' => 'FavRecipesController',
        ]);
    }
}
