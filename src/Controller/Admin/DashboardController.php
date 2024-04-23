<?php

namespace App\Controller\Admin;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Ingredient;
use App\Entity\Recipe;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{


    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(UserCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Dashboard Admin');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home','');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', Assurance::class);
        yield MenuItem::linkToCrud('Users', 'fa fa-users', User::class);
        yield MenuItem::linkToCrud('Recipe Category', 'fa fa-tags', Category::class); // "fa-tags" ou une autre icône qui représente des catégories ou des classifications.
        yield MenuItem::linkToCrud('Recipe', 'fa fa-book', Recipe::class); // "fa-book" pour représenter des recettes comme dans un livre de recettes.
        yield MenuItem::linkToCrud('Comment', 'fa fa-book', Comment::class);
        yield MenuItem::linkToCrud('Ingredient', 'fa fa-lemon', Ingredient::class); 


    }
}
