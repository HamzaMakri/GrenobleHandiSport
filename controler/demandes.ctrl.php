<?php

require_once('../framework/view.class.php');
require_once('../model/User.class.php');
require_once('../model/Demande.class.php');


session_start();

$demandesDOA = new InscriptionDOA();
$demandes = $demandesDOA->getAll();

if (isset($_GET['action']) && isset($_GET['num'] )) {
  if ($_GET['action'] == 'valider') {

    ////////////////// DANS UN PREMIER TEMPS ON PASSE VALIDE L'INSCRIPTION DANS LA BASE //////////////////////
    $vrai = '1';
    $sql = "UPDATE inscription SET validee=? WHERE numInscript=?";
    $result = $demandesDOA->pdo->prepare($sql);
    $result->execute([$vrai,$_GET['num']]);

    ///////////////// ENSUITE ON LUI CREE UN COMPTE DANS USER AVEC LEQUEL IL POURRA SE CONNECTER //////////

    // d'abord on recupere la bonne Inscription afin de recuperer les informations nécessaires :
    foreach ($demandes as $key => $value) {
      if ($value->numInscript == $_GET['num']) {
        $nouveauUser = $value;
        var_dump($nouveauUser);
      }
    }

    $db = new MyDB2();
    $sql = "INSERT INTO user (nom,prenom,mail,mdp,statut,numInscript) VALUES (:nom,:prenom,:mail,:mdp,:statut,:numInscript)";
    $result = $db->getPdo()->prepare($sql);
    var_dump($result);
    $result->execute(array(

      ':nom' => $nouveauUser->nom,
      ':prenom' => $nouveauUser->prenom,
      ':mail' => $nouveauUser->mail,
      ':mdp' => $nouveauUser->mdp,
      ':statut' => $nouveauUser->statut,
      ':numInscript' => $nouveauUser->numInscript
        ));

    $db =  NULL; // pour fermer la connexion

    header('location: ../controler/demandes.ctrl.php');


  } elseif ($_GET['action'] == 'refuser') {
    $num = $_GET['num'];
    $sql = "DELETE FROM inscription WHERE numInscript= $num";
    $demandesDOA->pdo->exec($sql);
    header('location: ../controler/demandes.ctrl.php');

  }
}



$view = new View('actu.view.php');

$view->assign('demandes',$demandes);

$view->display("demandes.view.php");
 ?>
