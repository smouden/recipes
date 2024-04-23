<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Like; // Assurez-vous que cette ligne est correctement ajoutée
use App\Entity\Recipe;


class FavRecipesController extends AbstractController
{

    #[Route('/favorite-recipes', name: 'favorite_recipes')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        // Vérifier que l'utilisateur est connecté
        if (!$user) {
            // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
            return $this->redirectToRoute('login_route'); // Assurez-vous que 'login_route' est le nom correct de votre route de connexion
        }

        // Récupérer les objets 'Like' pour l'utilisateur connecté
        $likes = $entityManager->getRepository(Like::class)->findBy(['liker' => $user]);

        // Extraire les recettes à partir des objets 'Like'
        $recipes = [];
        foreach ($likes as $like) {
            $recipes[] = $like->getRecipe();
        }

        // Envoyer les recettes à la vue
        return $this->render('fav_recipes/index.html.twig', [
            'recipes' => $recipes
        ]);
    }
}
