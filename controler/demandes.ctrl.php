<?php

require_once('../framework/view.class.php');
require_once('../model/User.class.php');
require_once('../model/Demande.class.php');


session_start();

$demandesDOA = new InscriptionDOA();
$demandes = $demandesDOA->getAll();

if (isset($_GET['action']) && isset($_GET['num'] )) {
  if ($_GET['action'] == 'valider') {
    $sql = "UPDATE inscription SET validee=? WHERE numInscript=?";
    $result = $demandesDOA->pdo->prepare($sql);
    $result = execute([1,$_GET['num']]);
    
  } elseif ($_GET['action'] == 'refuser') {
    $sql = "UPDATE inscription SET validee=? WHERE numInscript=?";
    $result = $demandesDOA->pdo->prepare($sql);
    $result = execute([1,$_GET['num']]);
  }
}



$view = new View('actu.view.php');

$view->assign('demandes',$demandes);

$view->display("demandes.view.php");
 ?>
