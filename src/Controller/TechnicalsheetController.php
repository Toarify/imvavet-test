<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TechnicalsheetController extends AbstractController
{
    #[Route('/technicalsheet', name: 'app_technicalsheet')]
    public function index(): Response
    {
        return $this->render('technicalsheet/technicalsheet.html.twig', [
            'controller_name' => 'TechnicalsheetController',
        ]);
    }
}
