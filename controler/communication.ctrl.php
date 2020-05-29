<?php

require_once('../framework/view.class.php');
require_once('../model/User.class.php');


if (!isset($_SESSION)) {
    session_start();
}

if (isset($_FILES)) {
  echo "ta mere";
}

  if ($_FILES && $_POST) {

    if (isset($_REQUEST["titre"]) && isset($_REQUEST["texte"]) ) {

      $titre = $_REQUEST["titre"];
      $txt = $_REQUEST["texte"];
      $destination = "../view/design/imgArticle/";
      $nom = basename($_FILES['imageArticle']['name']);

      if (move_uploaded_file($_FILES['imageArticle']['tmp_name'], $destination . $nom)){ //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        try {
          $pdo = new \PDO('mysql:host=localhost;dbname=grenoblehandisport', 'root', '', [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC ]);
        } catch (\Exception $e) {
          header('location: ../controler/communication.ctrl.php?valide=non');
          die('Erreur ' . $e->getMessage());
        }

        $sql = "INSERT INTO article (titre,texte,image) VALUES (:titre,:txt,:nom)";

        $result = $pdo->prepare($sql);
        $result->execute(array(
          ':titre' => $titre,
          ':txt' => $txt,
          ':nom' => $nom
        ));

      }

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['postdata'] = $_POST;
        unset($_POST);
        unset($_POST);
        //header("Location: ".$_SERVER['PHP_SELF']);
        exit;
      }
    }
    else {
      header('location: ../controler/communication.ctrl.php?valide=non');
    }
  }

  $view = new View('communication.view.php');

  $view->display("communication.view.php");


  ?>

  Gerer l'erreur quand : <br>
  on ouvre l'outil d'ingenieur et qu'on supprime manuellement le required puis qu'on ne met pas de titre ou de txt ou d'image<br>
