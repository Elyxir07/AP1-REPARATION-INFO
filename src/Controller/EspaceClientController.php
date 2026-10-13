<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DemandeRepository;

final class EspaceClientController extends AbstractController
{
    #[Route('/espace_client', name: 'app_espace_client')]
    public function index(DemandeRepository $demandeRepository): Response
    {
        $user = $this->getUser();
        
        $demandes = $demandeRepository->findBy(['IdUtil' => $user->getId()]); 

        return $this->render('espace_client/index.html.twig', [
            'controller_name' => 'EspaceClientController',
            'demandes' => $demandes,
        ]);
    }
}
