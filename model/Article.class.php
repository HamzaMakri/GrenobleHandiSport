<?php

/**
 *
 */
class ArticleDOA {
  public $pdo;

  function __construct(){
    try {
      $this->pdo = new \PDO('mysql:host=localhost;dbname=grenoblehandisport', 'root', '', [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC ]);
    } catch (\PDOException $e) {
      echo 'Connexion échouée : ' . $e->getMessage();
    }

  }

  public function getAll() : array {

    $requete = $this->pdo->query("SELECT * FROM article");

    $result = $requete->fetchAll(PDO::FETCH_CLASS,"Article");

    return $result;
  }
}



class Article {
  public $id;
  public $titre;
  public $date;
  public $texte;
  public $image;

  public function getcorps($admin): string{
    $annee = substr($this->date,0,4);
    $mois= substr($this->date,5,2);
    $jour= substr($this->date,8,2);

    $this->date = $jour.'/'.$mois.'/'.$annee;

if ($admin) {

  $corps = '
  <div class="article">
    <img src="../view/design/imgArticle/'.$this->image.'" >
    <div>
      <div class="header-art">
          <h4>'.$this->titre.'</h1>
          <p> <i>Le '.$this->date.'</i></p>
      </div>
          <p><b>Description :</b> '.$this->texte.'</p>
      </div>
    </div>
    <div class="suppr">
    <a href="communication.ctrl.php?action=suppr&num='.$this->id.'" >Supprimer</a>
    </div>
  </div>
  ';
}else {
  $corps = '
  <div class="article">
  <img src="../view/design/imgArticle/'.$this->image.'" >
  <div>
  <div class="header-art">
  <h4>'.$this->titre.'</h1>
  <p> <i>Le '.$this->date.'</i></p>
  </div>
  <p><b>Description :</b> '.$this->texte.'</p>
  </div>
  </div>
  ';
}

  return $corps;
  }

  function __construct()
  {

  }
}





 ?>
