<?php

namespace App\Controller\Admin;
use App\Entity\Contact;
use App\Entity\Insurance;
use App\Entity\Car;
use App\Entity\Picture;
use App\Entity\Reservation;
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
        $url = $routeBuilder->setController(InsuranceCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(CarCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(ReservationCrudController::class)->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('App');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home','');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', Assurance::class);
        yield MenuItem::linkToCrud('insurance', 'fa fa-handshake-o', Insurance::class);
        yield MenuItem::linkToCrud('cars', 'fa fa-car', Car::class);
        yield MenuItem::linkToCrud('Reservation', 'fa fa-address-card-o', Reservation::class);
        yield MenuItem::linkToCrud('Contact', 'fa fa-comments', Contact::class);
        yield MenuItem::linkToCrud('Users', 'fa fa-users', User::class);
        yield MenuItem::linkToCrud('Picture', 'fa fa-picture-o', Picture::class);
    }
}
