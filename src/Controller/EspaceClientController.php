<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use doctrine\Persistence\ManagerRegistry;

final class EspaceClientController extends AbstractController
{
    #[Route('/espace_client', name: 'app_espace_client')]
    public function index(): Response
    {
        $demandeRepository = $this->getDoctrine()->getRepository(Demande::class);
        $demandes = $demandeRepository->findOneBySomeField($idClient);
        return $this->render('espace_client/index.html.twig', [
            'controller_name' => 'EspaceClientController',
            'demandes' => $demandes,
        ]);
    }
}
