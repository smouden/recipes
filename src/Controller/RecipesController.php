<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecipeRepository;
use App\Entity\Comment;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

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

    #[Route('/Recipes/{id}', name: 'app_recipe_detail', requirements: ['id' => '\d+'])]
    public function detail(int $id, RecipeRepository $recipeRepository): Response
    {
        $recipe = $recipeRepository->find($id);

        if (!$recipe) {
            throw $this->createNotFoundException('La recette demandée n\'existe pas.');
        }

        // Ici, $recipe->getComments() récupère automatiquement les commentaires liés à la recette
        $comments = $recipe->getComments();

        return $this->render('single_recipe/index.html.twig', [
            'recipe' => $recipe,
            'comments' => $comments, // Passez les commentaires à la vue
        ]);
    }


    #[Route('/recipe/{id}/comment', name: 'recipe_add_comment', methods: ['POST'])]
    public function addComment(int $id, Request $request, RecipeRepository $recipeRepository, UserRepository $userRepository, EntityManagerInterface $entityManager, Security $security): Response
    {
        $user = $security->getUser(); // Supposons que vous avez un système d'authentification
        $recipe = $recipeRepository->find($id);

        if (!$recipe || !$user) {
            // Gérez l'erreur si la recette ou l'utilisateur n'est pas trouvé
            return $this->redirectToRoute('app_recipes');
        }

        $comment = new Comment();
        $comment->setContentComment($request->request->get('comment'));
        $comment->setDateComment(new \DateTime());
        $comment->setCommentator($user);
        $comment->setRecipe($recipe);

        $entityManager->persist($comment);
        $entityManager->flush();

        return $this->redirectToRoute('app_recipe_detail', ['id' => $id]);
    }






}
