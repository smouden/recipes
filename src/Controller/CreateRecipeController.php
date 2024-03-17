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
use Symfony\Component\Security\Core\Security;
// pour image du recette 
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;


class CreateRecipeController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    #[Route('/create_recipe', name: 'app_create_recipe')]
    public function index(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer l'utilisateur connecté et le définir comme créateur de la recette
            $user = $this->security->getUser();
            $recipe->setCreatorRecipe($user);

            // pour inserer l'image 
            /** @var UploadedFile $pictureFile */
            $pictureFile = $form->get('picture_recipe')->getData();

            if ($pictureFile) {
                $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $pictureFile->guessExtension();

                try {
                    $pictureFile->move(
                        $this->getParameter('recipes_directory'), // Vous devez configurer ce paramètre
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... gérer l'exception si quelque chose se passe pendant le téléchargement du fichier
                }

                $recipe->setPictureRecipe($newFilename);
            }

            // ... persister et flush l'entité

            $entityManager->persist($recipe);
            $entityManager->flush();

            // Stocker l'ID de la recette en session
            $request->getSession()->set('recipe_id', $recipe->getId());

            // Rediriger vers le formulaire de création d'ingrédients
            return $this->redirectToRoute('app_create_ingredients');
        }

        return $this->render('create_recipe/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
