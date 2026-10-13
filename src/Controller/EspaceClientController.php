<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use repository\DemandeRepository;

final class EspaceClientController extends AbstractController
{
    #[Route('/espace_client', name: 'app_espace_client')]
    public function index(): Response
    {
        $user = $this->getUser();
        $demandeRepository = $this->getRepository(Demande::class);
        $demandes= $demandeRepository->findByidUtilisateur($user->getId());
        return $this->render('espace_client/index.html.twig', [
            'controller_name' => 'EspaceClientController',
            'demandes' => $demandes,
        ]);
    }
}
