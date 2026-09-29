<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CreationDemandeController extends AbstractController
{
    #[Route('/creation-demande', name: 'app_creation_demande')]
    public function index(): Response
    {
        return $this->render('creation_demande/index.html.twig', [
            'controller_name' => 'CreationDemandeController',
        ]);
    }
}
