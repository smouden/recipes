<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// pour gerer le formualaire
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Recipe;
use App\Form\RecipeType;

class CreateRecipeController extends AbstractController
{
    #[Route('/create_recipe', name: 'app_create_recipe')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($recipe);
            $entityManager->flush();

            // Rediriger vers une autre page ou afficher un message de succès
            return $this->redirectToRoute('app_recipes');
        }

        return $this->render('create_recipe/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
