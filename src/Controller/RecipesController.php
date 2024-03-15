<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecipeRepository;

class RecipesController extends AbstractController
{
    #[Route('/Recipes', name: 'app_recipes')]
    public function index(Request $request, RecipeRepository $recipeRepository): Response
    {
        // Récupérer le terme de recherche à partir de la requête
        $searchTerm = $request->query->get('search', '');

        // Utiliser le terme de recherche pour filtrer les recettes ou obtenir toutes les recettes
        $recipes = $recipeRepository->findRecipesByTitle($searchTerm);

        // Passer les recettes à la vue
        return $this->render('recipes/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }

}
