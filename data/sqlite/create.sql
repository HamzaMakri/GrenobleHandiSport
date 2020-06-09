  CREATE TABLE user (
    id int,
    nom STRING,
    prenom STRING,
    age int,
    email STRING,
    mdp STRING,
    statut STRING
  );



/*


CREATE TABLE `user`(
  id INT NOT NULL AUTO_INCREMENT,
  nom VARCHAR(255) NOT NULL,
  prenom VARCHAR(255) NOT NULL,
  dateNaiss DATE NOT NULL,
  mail VARCHAR(255) NOT NULL,
  mdp VARCHAR(255) NOT NULL,
  statut ENUM('adherent','benevole','admin') NOT NULL,
  numInscript INT NOT NULL,

  PRIMARY KEY (id),
  FOREIGN KEY (numInscript) REFERENCES inscription(numInscript)
);

CREATE TABLE `inscription` (
  numInscript INT NOT NULL AUTO_INCREMENT,
  sexe ENUM('h','f') NOT NULL,
  nom VARCHAR(255) NOT NULL,
  prenom VARCHAR(255) NOT NULL,
  mail VARCHAR(255) NOT NULL,
  dateNaiss DATE NOT NULL,
  nationalite VARCHAR(255) NOT NULL,
  profession VARCHAR(255) NOT NULL,
  tel INT NOT NULL,
  adresse VARCHAR(255) NOT NULL,
  statut ENUM('adherent','benevole','admin') NOT NULL,
  validee BOOLEAN NOT NULL DEFAULT 1,
  handicap VARCHAR(255),
  attestationmedicale VARCHAR(255),
  date DATE DEFAULT CURRENT_DATE,

  PRIMARY KEY (numInscript)
);

CREATE TABLE `inscriptionSport` (
  nomsport VARCHAR(255) NOT NULL,
  numInscript int,

  PRIMARY KEY (numInscript,nomsport),
  FOREIGN KEY (numInscript) REFERENCES inscription(numInscript)
);












Choses à faire :

Valider une inscription
Faire un formulaire d'inscription speciale pour les benevoles
Pouvoir modifier son MDP


TESTS UNITAIRES :

Connexion/Déconnexion marche bien.
Enregistrement dans la base de donnée d’une inscription fonctionnel.
Une fois connecté, on n'a plus accès à la page d'inscription ni à celle de connexion.
Navbar spéciale sur la page de l’espace personnel et est différente en fonction du statut de l’utilisateur.
Impossible de créer plusieurs comptes avec le même mail, même en rafraichissant la page.




*/
