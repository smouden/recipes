<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Form\ChangePasswordType;




class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher, SluggerInterface $slugger): Response
    {
        $user = $this->getUser();

        if (!$user instanceof User) {
            return $this->redirectToRoute('app_login');
        }

        // Formulaire pour les informations de l'utilisateur
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        // Formulaire pour le changement de mot de passe
        $passwordForm = $this->createForm(ChangePasswordType::class);
        $passwordForm->handleRequest($request);

        // Gestion de la soumission du formulaire des informations de l'utilisateur
        if ($form->isSubmitted() && $form->isValid()) {
            $currentPassword = $form->get('currentPassword')->getData();

            // Vérifier le mot de passe actuel
            if (!$passwordHasher->isPasswordValid($user, $currentPassword)) {
                $this->addFlash('danger', 'Le mot de passe actuel est incorrect.');
                return $this->redirectToRoute('app_profile');
            }

            $pictureFile = $form->get('picture_user')->getData();
            if ($pictureFile) {
                $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $pictureFile->guessExtension();

                try {
                    $pictureFile->move(
                        $this->getParameter('users_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // Gérer les exceptions si quelque chose se passe mal pendant le téléchargement du fichier
                }

                $user->setPictureUser($newFilename);
            }

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Profil mis à jour avec succès !');
            return $this->redirectToRoute('app_profile');
        }

        // Gestion de la soumission du formulaire de changement de mot de passe
        if ($passwordForm->isSubmitted() && $passwordForm->isValid()) {
            $currentPassword = $passwordForm->get('currentPassword')->getData();
            $newPassword = $passwordForm->get('newPassword')->getData();

            if (!$passwordHasher->isPasswordValid($user, $currentPassword)) {
                $this->addFlash('danger', 'L\'ancien mot de passe est incorrect.');
                return $this->redirectToRoute('app_profile');
            }

            $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
            $user->setPassword($hashedPassword);

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Mot de passe mis à jour avec succès !');
            return $this->redirectToRoute('app_profile');
        }

        return $this->render('profile/index.html.twig', [
            'form' => $form->createView(),
            'passwordForm' => $passwordForm->createView(),
        ]);
    }
}
