<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PrestationRepository;
use App\Entity\Demande;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

final class CreationDemandeController extends AbstractController
{
    #[Route('/creation-demande', name: 'app_creation_demande')]
    public function index(PrestationRepository $prestation): Response
    {

        // Vérification si l'utilisateur est connecté
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $prestations = $prestation->findAll();

        return $this->render('creation_demande/index.html.twig', [
            'prestations' => $prestations,
        ]);
    }

    #[Route('/creer-demande', name: 'app_creer_demande', methods: ['POST'])]
    public function creer(Request $request, EntityManagerInterface $entityManager, PrestationRepository $prestationRepository): Response
    {
        $etat_demande = "en attente";
        $objet = $request->request->get('objet');
        $raison = $request->request->get('raison');
        $commentaire = $request->request->get('commentaire');
        // Récupère le tableau des IDs envoyés ([1, 4, 12...])
        $prestationIds = $request->request->all('prestations');
        $user = $this->getUser();

        $demande = new Demande();
        $demande->setEtatDemande('en attente');
        $demande->setObjet($objet);
        $demande->setRaison($raison);
        $demande->setCommentaire($commentaire);
        if ($user) {
            $demande->setIdUtil($user); // On passe directement l'objet Utilisateur
        }

        foreach ($prestationIds as $ref) {
            $prestation = $prestationRepository->find($ref);
            if ($prestation) {
                $demande->addPrestation($prestation);
            }
        }

        // Préparation de la sauvegarde par Doctrine
        $entityManager->persist($demande);

        // Exécution de la requête INSERT en BDD
        $entityManager->flush();

        return $this->redirectToRoute('app_accueil');
    }
}
