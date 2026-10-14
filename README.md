# Informations générales

Ce site web appartient à la société **REFI** et a été créé par **Comeleon**.

## Screenshots

![Screenshot Accueil](/public/img/readme/screenshot1.png)
![Screenshot Prestations](/public/img/readme/screenshot2.png)
![Screenshot Creation Demande](/public/img/readme/screenshot3.png)
![Screenshot Connexion](/public/img/readme/screenshot4.png)
![Screenshot Inscription](/public/img/readme/screenshot5.png)
![Screenshot Espace Client](/public/img/readme/screenshot6.png)
![Screenshot Espace Admin](/public/img/readme/screenshot7.png)

## Démarrage

Ce projet est réalisé en **Symfony** avec les librairies suivantes : **Make**, **Twig** et **ORM**.

Pour comprendre le fonctionnement du projet, je vous invite à aller dans la section [releases](https://github.com/Elyxir07/AP1-REPARATION-INFO/releases) contenant le projet en fichier ZIP.

## Fonctionnalités

- Les clients sont accueillis par une page vitrine de la marque **REFI**.

- Ils peuvent regarder la **liste des prestations** mais également formuler une **demande** pouvant contenir plusieurs prestations.

- Ils ont accès à un **espace client** afin de consulter leurs dernières demandes effectuées.

- L'administrateur possède son **propre espace** pour la gestion des clients.

## Déploiement

Le projet est constitué avec la méthode **GitFlow** :

- **master**, la branche de **production**.

- **dev**, la branche de **développement**.

- **feature**, la branche d'ajouts de **fonctionnalités**.

- **release**, la branche de **test** avant déploiement en production.

- **hotfix**, la branche pour la **correction de bugs critiques** sur la production.

## Technologies utilisées

- **Visual Studio Code** (programmation).

- **GitKracken** (gestion des versions).

- **Un serveur Symfony**.

- Une **base de données** auto-hébergée (gestion de deux bases de données distantes).

## Comment contribuer

Vous pouvez contribuer au projet en **testant les dernières fonctionnalités** ou bien en **proposant des idées d'amélioration** dans la section **Issues**.

Vérifiez que vous possédez les **bundles** requis : Make, Twig et ORM.

Pour exécuter le projet, rendez-vous à la raine du projet puis démarrez le projet Symfony en utilisant la commande suivante :

`symfony server:start`

Vérifiez la variable **DATABASE_URL** dans vote .env afin de vous **relier** correctement à votre base de données !

Puis en important la base de données avec :

`php bin/console doctrine:database:create`

`php bin/console doctrine:migrations:migrate`

Voici la commande pour essayer avec un jeu de tests :

`php bin/console doctrine:fixtures:load`

Voici les différents identifiants utilisés :

Compte Client : nom_du_client@example.com, password123

Compte Administrateur : admin@example.com, admin123

## Crédits / Auteurs

Elyxir07 : Fontaine Eliot

Lilian637 : Lilian Coutant

Theo-chevalier07 : Théo Chevalier

## Licence

Aucune