<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Ingredient;
use App\Form\IngredientType;
use Doctrine\ORM\EntityManagerInterface;
// pour recevoir l'id passé par recipe
use App\Entity\Recipe;


class CreateIngredientsController extends AbstractController
{
    #[Route('/create_ingredients', name: 'app_create_ingredients', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ingredient = new Ingredient();
        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer l'ID de la recette depuis la session
            $recipeId = $request->getSession()->get('recipe_id');
            if (!$recipeId) {
                throw $this->createNotFoundException('Aucune recette trouvée pour ajouter lingrédient.');
            }

            $recipe = $entityManager->getRepository(Recipe::class)->find($recipeId);
            $recipe->addIngredient($ingredient);

            $entityManager->persist($ingredient);
            $entityManager->flush();

            $this->addFlash('success', 'Ingrédient ajouté avec succès!');

            // Laisser l'utilisateur ajouter d'autres ingrédients ou finaliser la recette
            return $this->redirectToRoute('app_create_ingredients');
        }

        return $this->render('create_ingredients/index.html.twig', [
            'ingredient_form' => $form->createView(),
            // Passer l'ID de la recette en cours de création à la vue pourrait être utile
            'recipe_id' => $request->getSession()->get('recipe_id'),
        ]);
    }
}
