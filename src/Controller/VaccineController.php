<?php

namespace App\Controller;

use App\Entity\Vaccine;
use App\Repository\VaccineRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VaccineController extends AbstractController
{
    #[Route('/vaccine', name: 'app_vaccine')]
    public function index(): Response
    {
        return $this->render('vaccine/index.html.twig', [
            'controller_name' => 'VaccineController',
        ]);
    }

    #[Route('/vaccines', name: 'app_vaccines')]
    public function index2(VaccineRepository $vaccineRepository): Response
    {
        $vaccines = $vaccineRepository->findAll();
        // Séparer les articles par type
        $gameAviaire = array_filter($vaccines, fn($vaccine) => $vaccine->getGame() === 'Aviaire');
        $gamePorcine = array_filter($vaccines, fn($vaccine) => $vaccine->getGame() === 'Porcine');
        $gameRimunant = array_filter($vaccines, fn($vaccine) => $vaccine->getGame() === 'Rimunant');
        $gameCanine = array_filter($vaccines, fn($vaccine) => $vaccine->getGame() === 'Canine');

        return $this->render('vaccine/vaccine.html.twig', [
            'vaccines' => $vaccines,
            'gameAviaire' => $gameAviaire,
            'gamePorcine' => $gamePorcine,
            'gameRimunant' => $gameRimunant,
            'gameCanine' => $gameCanine
        ]);
    }

    #[Route('/vaccines/{id}', name: 'vaccine_show')]
    public function show(Vaccine $vaccine): Response
    {
        return $this->render('vaccine/show.html.twig', [
            'vaccine' => $vaccine,
        ]);
    }
}
