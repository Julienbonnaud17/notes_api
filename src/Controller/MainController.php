<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        // Liste manuelle des routes avec description
        $routes = [
            ['method' => 'GET',    'url' => '/api/notes',          'desc' => 'Liste toutes les notes'],
            ['method' => 'GET',    'url' => '/api/notes/{id}',     'desc' => 'Affiche une note par son ID'],
            ['method' => 'POST',   'url' => '/api/notes',          'desc' => 'Crée une nouvelle note'],
            ['method' => 'PUT',    'url' => '/api/notes/{id}',     'desc' => 'Modifie une note existante'],
            ['method' => 'DELETE', 'url' => '/api/notes/{id}',     'desc' => 'Supprime une note'],
        ];

        return $this->render('home/index.html.twig', [
            'routes' => $routes,
        ]);
    }
}
