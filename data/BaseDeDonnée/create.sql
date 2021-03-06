
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





/*

Choses à faire :

Valider une inscription
Faire un formulaire d'inscription speciale pour les benevoles
Pouvoir modifier son MDP


TESTS PROTOTYPE:

Connexion/Déconnexion marche bien.
Enregistrement dans la base de donnée d’une inscription fonctionnel.
Une fois connecté, on n'a plus accès à la page d'inscription ni à celle de connexion.
Navbar spéciale sur la page de l’espace personnel et est différente en fonction du statut de l’utilisateur.
Impossible de créer plusieurs comptes avec le même mail, même en rafraichissant la page.




*/
