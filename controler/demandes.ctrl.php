<?php

require_once('../framework/view.class.php');
require_once('../model/User.class.php');
require_once('../model/Demande.class.php');


session_start();

$demandesDOA = new InscriptionDOA();
$demandes = $demandesDOA->getAll();

var_dump($demandes);



$view = new View('actu.view.php');

$view->assign('demandes',$demandes);

$view->display("demandes.view.php");
 ?>
