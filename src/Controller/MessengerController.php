<?php

namespace App\Controller;

use Symfony\Component\Process\Process;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MessengerController extends AbstractController
{
    #[Route('/start-worker', name: 'start_worker')]
    public function startWorker(): JsonResponse
    {
        // Vérifier si un worker est déjà en cours
        $pidFile = 'messenger.pid';
        if (file_exists($pidFile)) {
            $pid = file_get_contents($pidFile);
            // Vérifier si le processus est toujours en cours d'exécution
            $checkProcess = new Process(['ps', '-p', $pid]);
            $checkProcess->run();

            if ($checkProcess->isSuccessful()) {
                return new JsonResponse(['status' => 'error', 'message' => 'Worker is already running'], 400);
            }
        }

        // Obtenir le chemin absolu du fichier bin/console
        $projectDir = $this->getParameter('kernel.project_dir');
        $consolePath = realpath($projectDir . '/bin/console');

        if (!$consolePath) {
            return new JsonResponse(['status' => 'error', 'message' => 'Console file not found'], 500);
        }

        // Préparer la commande nohup avec PID
        $command = ['nohup', 'php', $consolePath, 'messenger:consume', 'async', '-vv', '>>', 'messenger.log', '2>&1', '&', 'echo', '$! > ' . $pidFile];

        // Démarrer le processus en arrière-plan
        $process = new Process($command);
        $process->setTimeout(null);
        
        try {
            // Exécuter la commande en tâche de fond
            $process->start();

            // Capturer les erreurs de la sortie standard
            $process->wait();

            return new JsonResponse([
                'status' => 'success',
                'message' => 'Worker started successfully',
                'output' => $process->getOutput(),
                'error_output' => $process->getErrorOutput()
            ]);
        } catch (ProcessFailedException $exception) {
            return new JsonResponse([
                'status' => 'error',
                'message' => $exception->getMessage(),
                'error_output' => $process->getErrorOutput()
            ], 500);
        }
    }
}

