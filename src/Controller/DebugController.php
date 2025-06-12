<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DebugController extends AbstractController
{
    #[Route('/debug', name: 'app_debug')]
    public function logTest(): Response
    {
        file_put_contents(
            '../var/log/prod.log',
            date('[Y-m-d H:i:s]')." Test de log\n",
            FILE_APPEND
        );
        return new Response('Check les logs !');
    }
}
