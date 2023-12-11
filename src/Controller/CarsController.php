<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CarRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Reservation;
use App\Form\BookingFormType;
use Doctrine\ORM\EntityManagerInterface;


class CarsController extends AbstractController
{
    #[Route('/cars', name: 'app_cars')]
    public function index(CarRepository $carRepository): Response
    {
        // Logique pour obtenir la liste des voitures
        $cars = $carRepository->findAll();

        return $this->render('cars/index.html.twig', [
            'cars' => $cars,
        ]);
    }

    #[Route('/cars/{id}', name: 'car_details')]
    public function details(CarRepository $carRepository, $id): Response
    {
        // Logique pour obtenir les détails d'une voiture spécifique
        $car = $carRepository->find($id);

        if (!$car) {
            throw $this->createNotFoundException('La voiture demandée n\'existe pas.');
        }

        return $this->render('cars/informations.html.twig', [
            'car' => $car,
        ]);
    }

    #[Route('/cars/booking/{id}', name: 'car_booking')]
    public function booking(CarRepository $carRepository, $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Récupérez la voiture sélectionnée
        $car = $carRepository->find($id);
        if (!$car) {
            // Gérez l'erreur si la voiture n'existe pas
            throw $this->createNotFoundException('La voiture demandée n\'existe pas.');
        }


        $reservation = new Reservation();
        $reservation->setCar($car);

        $bookingForm = $this->createForm(BookingFormType::class, $reservation);
        $bookingForm->handleRequest($request);

        if ($bookingForm->isSubmitted() && $bookingForm->isValid()) {
            // Peut-être définir un statut par défaut pour la réservation
            // $reservation->setReservationStatuts(true/false);

            $entityManager->persist($reservation);
            $entityManager->flush();

            // Rediriger ou ajouter un message flash après la sauvegarde
            //$this->addFlash('success', 'Réservation enregistrée avec succès.');
            //return $this->redirectToRoute('');
        }


        // Rendre le template de réservation avec le formulaire et les détails de la voiture
        return $this->render('cars/booking.html.twig', [
            'car' => $car,
            'form' => $bookingForm->createView(),
        ]);
    }
}
