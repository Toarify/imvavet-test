<?php

namespace App\Controller;

use App\Repository\AboutRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AboutController extends AbstractController
{
    #[Route('/about', name: 'app_about')]
    public function index(AboutRepository $vaccineRepository): Response
    {
        $abouts = $vaccineRepository->findAll();
        return $this->render('about/about.html.twig', [
            'controller_name' => 'AboutController',
            'abouts' => $abouts,
        ]);
    }

}
