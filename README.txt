==================================================================================================================================================
========================================= A LIRE AVANT DE CONSULTER LE SITE =========================================================================
==================================================================================================================================================



Bonjour,


Voici quelques informations à savoir avant de vous lancer sur notre site :

Afin qu'un compte soit créé, il faut tout d'abord qu'un utilisateur fasse une demande d'inscription en remplissant le formulaire.
Une fois celui-ci bien rempli avec tous les champs nécessaires, une demande est automatiquement transmise aux administrateurs.
Un mail est également envoyé à leur adresse.

Afin de vérifier cela, une fois le formulaire remplis, nous vous invitions à vous connecter aux comptes gmail suivants :

--- BOITE EMETRICE DU MAIL : ---
mail = grenoblehandisportenvoi@gmail.com
mdp = testEnvoi

--- BOITE RECEPTRICE DU MAIL : ---
mail = grenoblehandireception@gmail.com
mdp = testEnvoi

Vous remarquerez également que la demande d'inscription est réservée uniquement aux adhérents et aux bénévoles, il n'est donc pas possible de créer de nouveaux administrateurs
Néanmoins, nous avons au préalable déjà créé plusieurs comptes : un admin, un bénévole et un adhèrent
Voici leurs identifiants afin de vous y connecter :

--- ADMIN ---
mail = admin@mail.com
mdp = azerty

--- ADHERENT ---
mail = adherent@mail.com
mdp = azerty

--- BENEVOLE ---
mail = benevole@mail.com
mdp = azerty


Maintenant que vous avez accès au compte admin, vous pouvez accéder à l'espace personnel (ou espace de gestion) où vous pourrez :
- CONSULTER L'AGENDA ET CREER DES EVENEMENTS
- CREER DES ARTICLE A PARTIR DE LA PAGE COMMUNICATION
- ACCEPTER/REFUSER LES DEMANDES D'INSCRIPTION
- CONSULTER TOUES LES COMPTES UTILISATEUR (admin/bénévole/adhèrent)

---- CONSULTER L'AGENDA ET CREER DES EVENEMENTS -----

En arrivant sur l'espace personnel, l'agenda s'affiche automatiquement, mais vous pouvez également y accéder depuis le bouton AGENDA du navbar si vous vous situez sur une autre page
Sur cet agenda, vous pouvez :
  - Parcourir les mois à l'aide des flèches au haut à droite
  - Ajouter des évènements à l'aide de la croix en bas à droite
  - Ajouter des évènements en cliquant directement sur un jour
  - Consulter un évènement en cliquant dessus afin d'éventuellement le modifier
Nous vous invitions donc à vous "amuser" avec celui-ci en le parcourant et en ajoutant des évènements à votre guise

Déconnectez-vous et reconnectez-vous avec un autre compte (adhèrent ou bénévole) et constatez que pour les comptes de ces statuts, il est impossible de modifier des évènements, seulement de parcourir le calendrier

----- CREER DES ARTICLE A PARTIR DE LA PAGE COMMUNICATION -----

Sur l'espace personnel de l'admin, cliquez sur COMMUNICATION et remplissez les champs nécessaires avant de valider, remarquez que l'article que vous venez de créer est apparu juste en dessous. Créez en plusieurs autres, ils s'afficheront en colonne avec pour chacun un bouton supprimer qui permet de ... supprimer l'article
Ces articles ainsi créé apparaissent également dans la page ACTUALITE en dehors de l'espace perso, que l'on soit connecté ou non.

----- ACCEPTER/REFUSER LES DEMANDES D'INSCRIPTION -----

Sur l'espace personnel de l'admin, cliquez sur DEMANDES D'INSCRIPTION, la liste de toutes les demandes qui n'ont pas encore été validé s’affiche ici. Il est donc nécessaire que vous ayez au préalable fait quelques demandes (pour cela, déconnectez-vous).
Vous avez toutes les informations (ou presque, petit soucis pour la date de naissance) concernant la demande. Le champ handicap et certificat médical ne sont pas nécessaires à la validation de la demande (demande de la présidente), c'est pour cela qu'il se peut que ces informations soient manquantes car vous ne les avez pas renseignées.
Si une demande est refusée, elle est complètement supprimée de la base
Une fois validée, une demande est conservée dans la base, seul un attribut (validée) passe de 0 à 1, cela nous permet de conserver les informations renseignées afin de créer un compte et d'avoir une fiche information sur chaque individu. (Chaque compte créé est lié à sa demande d'inscription)

Malheureusement, les sports auquel l'utilisateur s'est inscrit ne s'affichent pas, mais ce n'est là qu'un problème d'affichage (ou plutôt un oubli), la liste de ces sports est bien enregistré dans la base (voir sa structure en fin de fichier)

----- CONSULTER TOUES LES COMPTES UTILISATEUR (admin/benevole/adherent) -----
Simplement une liste de tous les comptes existant avec quelques informations pratique

=======================================================================================================

Finalement, constatez que les navbar ainsi que les boutons situez tout en haut à droite changent en fonction de la situation, c'est à dire, si vous êtes connecté ou non, et si oui, si vous êtes dans votre espace personnel ou non.

Vous trouverez ci-dessous les requêtes qui nous ont permis de créer notre base de données afin que vous puissiez imaginer sa structure, à défaut de vous fournir un schema.

Vous êtes bien entendu libre de naviguer comme bon vous semble sur notre site afin de découvrir par vous-même toutes autres fonctionnalités que l'on aura omis de vous parler.

===================================================================================================
=========================================BASE DE DONNEE:===========================================
===================================================================================================




CREATE TABLE `inscription` (
  numInscript INT NOT NULL AUTO_INCREMENT,
  sexe ENUM('h','f') NOT NULL,
  nom VARCHAR(255) NOT NULL,
  prenom VARCHAR(255) NOT NULL,
  mail VARCHAR(255) NOT NULL,
  mdp VARCHAR(255) NOT NULL,
  dateNaiss DATE NOT NULL,
  nationalite VARCHAR(255) NOT NULL,
  profession VARCHAR(255) NOT NULL,
  tel INT NOT NULL,
  adresse VARCHAR(255) NOT NULL,
  statut ENUM('adherent','benevole','admin') NOT NULL,
  validee BOOLEAN NOT NULL DEFAULT 0,
  handicap VARCHAR(255),
  attestationmedicale VARCHAR(255),
  date DATE DEFAULT CURRENT_DATE,

  PRIMARY KEY (numInscript)
);

CREATE TABLE `user`(
  id INT NOT NULL AUTO_INCREMENT,
  nom VARCHAR(255) NOT NULL,
  prenom VARCHAR(255) NOT NULL,
  mail VARCHAR(255) NOT NULL,
  mdp VARCHAR(255) NOT NULL,
  statut ENUM('adherent','benevole','admin') NOT NULL,
  numInscript INT,

  PRIMARY KEY (id),
  FOREIGN KEY (numInscript) REFERENCES inscription(numInscript)
);

INSERT INTO `user`
(`id`, `nom`, `prenom`, `mail`, `mdp`, `statut`)
VALUES (NULL, 'MAKRI', 'Hamza', 'admin@mail.com', 'azerty', 'admin');

INSERT INTO `user`
(`id`, `nom`, `prenom`, `mail`, `mdp`, `statut`)
VALUES (NULL, 'ADHERENT', 'Adherent', 'adherent@mail.com', 'azerty', 'adherent');

INSERT INTO `user`
(`id`, `nom`, `prenom`, `mail`, `mdp`, `statut`)
VALUES (NULL, 'BENEVOLE', 'Benevole', 'benevole@mail.com', 'azerty', 'benevole');

CREATE TABLE `inscriptionSport` (
  nomsport VARCHAR(255) NOT NULL,
  numInscript int,

  PRIMARY KEY (numInscript,nomsport),
  FOREIGN KEY (numInscript) REFERENCES inscription(numInscript)
);


CREATE TABLE `article` (
  id INT PRIMARY KEY AUTO_INCREMENT,
  titre VARCHAR(255) NOT NULL,
  date DATE DEFAULT CURRENT_DATE,
  texte TEXT,
  image VARCHAR(255) DEFAULT NULL
);

CREATE TABLE `events`(
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  description TEXT,
  start DATETIME NOT NULL,
  end DATETIME NOT NULL
  PRIMARY KEY (`id`)
);
