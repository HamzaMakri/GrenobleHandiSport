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

  public function getcorps(): string{
      $corps = '
      <div class="article">
        <img src="../view/design/imgArticle/'.$this->image.'" >
        <div>
            <div class="header">
              <h4>'.$this->titre.'</h1>
              <p>'.$this->date.'</p>
            </div>
            <p><b>Description :</b> '.$this->texte.'</p>
        </div>
      </div>
      ';
      return $corps;
  }

  function __construct()
  {

  }
}





 ?>
