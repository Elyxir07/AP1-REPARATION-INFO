<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use App\Entity\Materiel;
use App\Entity\Prestation;
use App\Entity\Demande;
use App\Entity\Utiliser;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    // 1. Injection du service de hachage via le constructeur
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // =========================
        // UTILISATEURS
        // =========================

        $utilisateur1 = new Utilisateur();
        $utilisateur1->setEmail('jean.dupont@example.com');
        // 2. Utilisation du hacheur Symfony
        $utilisateur1->setMdp($this->passwordHasher->hashPassword($utilisateur1, 'password123'));
        $utilisateur1->setNom('Dupont');
        $utilisateur1->setPrenom('Jean');
        $utilisateur1->setRue('10 rue de Paris');
        $utilisateur1->setCp('75001');
        $utilisateur1->setVille('Paris');
        $utilisateur1->setNumTel('0612345678');
        $utilisateur1->setType('client');

        $utilisateur2 = new Utilisateur();
        $utilisateur2->setEmail('marie.martin@example.com');
        $utilisateur2->setMdp($this->passwordHasher->hashPassword($utilisateur2, 'password123'));
        $utilisateur2->setNom('Martin');
        $utilisateur2->setPrenom('Marie');
        $utilisateur2->setNumTel('0623456789');
        $utilisateur2->setType('client');

        $utilisateur3 = new Utilisateur();
        $utilisateur3->setEmail('admin@example.com');
        $utilisateur3->setMdp($this->passwordHasher->hashPassword($utilisateur3, 'admin123'));
        $utilisateur3->setNom('Admin');
        $utilisateur3->setPrenom('Administrateur');
        $utilisateur3->setNumTel('0601020304');
        $utilisateur3->setType('admin');

        $manager->persist($utilisateur1);
        $manager->persist($utilisateur2);
        $manager->persist($utilisateur3);


        // =========================
        // MATERIELS
        // =========================

        $materiel1 = new Materiel();
        $materiel1->setReference('MAT-001');
        $materiel1->setType('Ordinateur');
        $materiel1->setMarque('Dell');
        $materiel1->setStock(15);

        $materiel2 = new Materiel();
        $materiel2->setReference('MAT-002');
        $materiel2->setType('Ecran');
        $materiel2->setMarque('Samsung');
        $materiel2->setStock(25);

        $materiel3 = new Materiel();
        $materiel3->setReference('MAT-003');
        $materiel3->setType('Clavier');
        $materiel3->setMarque('Logitech');
        $materiel3->setStock(40);

        $materiel4 = new Materiel();
        $materiel4->setReference('MAT-004');
        $materiel4->setType('Souris');
        $materiel4->setMarque('Logitech');
        $materiel4->setStock(50);

        $manager->persist($materiel1);
        $manager->persist($materiel2);
        $manager->persist($materiel3);
        $manager->persist($materiel4);


        // =========================
        // PRESTATIONS
        // =========================

        $prestation1 = new Prestation();
        $prestation1->setReference('PRESTA-001');
        $prestation1->setNom('Installation informatique');
        $prestation1->setPrix('150.00');

        $prestation2 = new Prestation();
        $prestation2->setReference('PRESTA-002');
        $prestation2->setNom('Maintenance informatique');
        $prestation2->setPrix('80.00');

        $prestation3 = new Prestation();
        $prestation3->setReference('PRESTA-003');
        $prestation3->setNom('Installation réseau');
        $prestation3->setPrix('250.00');

        $manager->persist($prestation1);
        $manager->persist($prestation2);
        $manager->persist($prestation3);


        // =========================
        // UTILISER
        // PRESTATION <-> MATERIEL
        // =========================

        $utiliser1 = new Utiliser();
        $utiliser1->setRefPresta($prestation1);
        $utiliser1->setRefMat($materiel1);
        $utiliser1->setQuantite(1);

        $utiliser2 = new Utiliser();
        $utiliser2->setRefPresta($prestation1);
        $utiliser2->setRefMat($materiel2);
        $utiliser2->setQuantite(2);

        $utiliser3 = new Utiliser();
        $utiliser3->setRefPresta($prestation2);
        $utiliser3->setRefMat($materiel3);
        $utiliser3->setQuantite(1);

        $utiliser4 = new Utiliser();
        $utiliser4->setRefPresta($prestation2);
        $utiliser4->setRefMat($materiel4);
        $utiliser4->setQuantite(1);

        $utiliser5 = new Utiliser();
        $utiliser5->setRefPresta($prestation3);
        $utiliser5->setRefMat($materiel1);
        $utiliser5->setQuantite(1);

        $utiliser6 = new Utiliser();
        $utiliser6->setRefPresta($prestation3);
        $utiliser6->setRefMat($materiel2);
        $utiliser6->setQuantite(2);

        $manager->persist($utiliser1);
        $manager->persist($utiliser2);
        $manager->persist($utiliser3);
        $manager->persist($utiliser4);
        $manager->persist($utiliser5);
        $manager->persist($utiliser6);


        // =========================
        // DEMANDES
        // =========================

        $demande1 = new Demande();
        $demande1->setEtatDemande('en attente');
        $demande1->setObjet('Installation de postes');
        $demande1->setRaison('Nouveau matériel');
        $demande1->setCommentaire(
            'Installation de deux ordinateurs dans les nouveaux bureaux.'
        );
        $demande1->setIdUtil($utilisateur1);
        $demande1->setRefPresta($prestation1);

        $demande2 = new Demande();
        $demande2->setEtatDemande('acceptee');
        $demande2->setObjet('Maintenance du parc');
        $demande2->setRaison('Maintenance');
        $demande2->setCommentaire(
            'Vérification et maintenance des postes informatiques.'
        );
        $demande2->setIdUtil($utilisateur2);
        $demande2->setRefPresta($prestation2);

        $demande3 = new Demande();
        $demande3->setEtatDemande('terminee');
        $demande3->setObjet('Installation réseau');
        $demande3->setRaison('Nouveau réseau');
        $demande3->setCommentaire(
            'Mise en place du réseau dans les nouveaux locaux.'
        );
        $demande3->setIdUtil($utilisateur1);
        $demande3->setRefPresta($prestation3);

        $manager->persist($demande1);
        $manager->persist($demande2);
        $manager->persist($demande3);


        // =========================
        // ENREGISTREMENT
        // =========================

        $manager->flush();
    }
}