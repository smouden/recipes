<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class HistoricController extends AbstractController
{
    #[Route('/historic', name: 'app_historic')]
    public function index(Security $security): Response
    {
        $user = $security->getUser(); // Récupère l'utilisateur connecté
        $recipes = $user->getRecipe(); // Récupère les recettes de cet utilisateur

        return $this->render('historic/index.html.twig', [
            'recipes' => $recipes, // Passer les recettes à la vue
        ]);
    }
    
}
