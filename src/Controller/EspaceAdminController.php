<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DemandeRepository;

final class EspaceAdminController extends AbstractController
{
    #[Route('/espace/admin', name: 'app_espace_admin')]
    public function index(DemandeRepository $demandeRepository): Response
    {
        $demandes = $demandeRepository->findAll();
        return $this->render('espace_Admin/index.html.twig', [
            'controller_name' => 'EspaceAdminController',
            'demandes' => $demandes,
        ]);
    }
}
