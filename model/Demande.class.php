<?php

/**
 *
 */
class InscriptionDOA {
  public $pdo;

  function __construct(){
    try {
      $this->pdo = new \PDO('mysql:host=localhost;dbname=grenoblehandisport', 'root', '', [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC ]);
    } catch (\PDOException $e) {
      echo 'Connexion échouée : ' . $e->getMessage();
    }

  }

  public function getAll() : array {

    $requete = $this->pdo->query("SELECT * FROM inscription");

    $result = $requete->fetchAll(PDO::FETCH_CLASS,"Inscription");

    return $result;
  }
}



class Inscription {

  public $numInscript;
  public $sexe;
  public $nom;
  public $prenom;
  public $mail;
  public $mdp;
  public $datenaiss;
  public $nationalite;
  public $profession;
  public $tel;
  public $adresse;
  public $statut;
  public $validee;
  public $handicap;
  public $attestationmedicale;
  public $date;


  function __construct()
  {

  }

  public function getcorps(): string{
      $corps = '
      <div class="demande">
        <div class="demande-infoPerso">
          <p>Nom : '.$this->nom.'</p>
          <p>Prenom : '.$this->prenom.'</p>
          <p>Sexe : '.$this->sexe.'</p>
          <p>Date de naissance : '.$this->datenaiss.'</p>
          <p>Nationalité : '.$this->nationalite.'</p>
          <p>Profession : '.$this->profession.'</p>
          <p>Handicap : '.$this->handicap.'</p>
          <p>Adresse : '.$this->adresse.'</p>
          <p>Statut : '.$this->statut.'</p>
          <p>Téléphone : '.$this->tel.'</p>
          <p>Certificat médical : '.$this->attestationmedicale.'</p><br>
        </div>

        <div class="demande-id-mdp">
          <p>Mail : '.$this->mail.'</p>
          <p>Mot de passe : '.$this->mdp.'</p>
        </div>

      </div>
      ';
      return $corps;
  }


}





















/*

class Inscription {

  public $numInscript;
  public $sexe;
  public $name;
  public $prenom;
  public $email;
  public $password;
  public $datenaiss;
  public $nationalite;
  public $profession;
  public $tel;
  public $adresse;
  public $statut;
  public $validee;
  public $handicap;
  public $attestationmedicale;
  public $date;
  public $sport; //tableau de plusieurs sports


  public function getcorps(): string{
      $corps = '
      <div class="demande">
        <div class="demande-infoPerso">
          <p>Nom : '.$this->$name.'</p>
          <p>Prenom : '.$this->$prenom.'</p>
          <p>Sexe : '.$this->$sexe.'</p>
          <p>Date de naissance : '.$this->$datenaiss.'</p>
          <p>Nationalité : '.$this->$nationalite.'</p>
          <p>Profession : '.$this->$profession.'</p>
          <p>Handicap : '.$this->$handicap.'</p>
          <p>Adresse : '.$this->$adresse.'</p>
          <p>Statut : '.$this->$statut.'</p>
          <p>Téléphone : '.$this->$tel.'</p>
          <p>Certificat médical : '.$this->$attestationmedicale.'</p><br>
        </div>

        <div class="demande-sports">
          <p>Sport(s) inscrit :</p><br>
          <ul>
          ';

          foreach ($this->$sport as $key => $value) {
            $corps = $corps.'<li>'.$value.' </li>';
          }
          $corps = $corps.'
          </ul>
        </div>

        <div class="demande-id-mdp">
          <p>Mail : '.$this->$email.'</p>
          <p>Mot de passe : '.$this->$password.'</p>
        </div>


      </div>
      ';
      return $corps;
  }

  function __construct()
  {

  }
}
*/



 ?>
