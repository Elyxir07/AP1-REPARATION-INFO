<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\PrestationRepository;
use App\Entity\Demande;

final class CreationDemandeController extends AbstractController
{
    #[Route('/creation-demande', name: 'app_creation_demande')]
    public function index(PrestationRepository $prestation): Response
    {

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
        $idUtil = $request->request->get('idUtil');

        foreach ($prestationIds as $id) {
            $prestation = $prestationRepository->find($id);
            if ($prestation) {
                $demande = new Demande();
                $demande->setRefPrestaId($id);
                $demande->setRaison($raison);
                $demande->setCommentaire($commentaire);
            }
        }

        // 4. Préparation de la sauvegarde par Doctrine
        $entityManager->persist($demande);

        // 5. Exécution de la requête INSERT en BDD
        $entityManager->flush();

        // 6. Redirection ou message de succès
        $this->addFlash('success', 'Votre demande a bien été enregistrée !');

        return $this->redirectToRoute('app_creation_demande');
    }
}
