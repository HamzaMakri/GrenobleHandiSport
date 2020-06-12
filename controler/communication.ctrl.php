<?php

require_once('../framework/view.class.php');
require_once('../model/User.class.php');
require_once('../model/Article.class.php');


$articlesDOA = new ArticleDOA();
$articles = $articlesDOA->getAll();


if (!isset($_SESSION)) {
    session_start();
}
if (isset($_GET['action']) && isset($_GET['num'])) {
  if ($_GET['action'] == 'suppr' ) {
    $num = $_GET['num'];
    $sql = "DELETE FROM article WHERE id= $num";
    $articlesDOA->pdo->exec($sql);
    header('location: ../controler/communication.ctrl.php');

  }
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
        header("Location:../controler/communication.ctrl.php");
        exit;
      }
    }
    else {
      header('location: ../controler/communication.ctrl.php?valide=non');
    }
  }

  $view = new View('communication.view.php');
  $view->assign('articles',$articles);

  $view->display("communication.view.php");


  ?>
