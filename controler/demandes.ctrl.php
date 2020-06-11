<?php

require_once('../framework/view.class.php');
require_once('../model/User.class.php');
require_once('../model/Demande.class.php');


session_start();

$demandesDOA = new InscriptionDOA();
$demandes = $demandesDOA->getAll();

if (isset($_GET['action']) && isset($_GET['num'] )) {
  if ($_GET['action'] == 'valider') {
    $vrai = '1';
    $sql = "UPDATE inscription SET validee=? WHERE numInscript=?";
    $result = $demandesDOA->pdo->prepare($sql);
    $result->execute([$vrai,$_GET['num']]);
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
