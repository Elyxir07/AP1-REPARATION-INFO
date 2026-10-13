<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Demande;
use App\Repository\DemandeRepository;
use App\Form\ModifDemandeType;

final class ModifierDemandeController extends AbstractController
{
    #[Route('/modifier/demande/{id}', name: 'app_modifier_demande')]
    public function index(Request $request,Demande $demande, DemandeRepository $demandeRepository, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ModifDemandeType::class, $demande);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_espace_admin');
        }
        return $this->render('modifier_demande/index.html.twig', [
            'controller_name' => 'ModifierDemandeController',
            'form' => $form->createView(),
            'demande' => $demande,
        ]);
    }
}
