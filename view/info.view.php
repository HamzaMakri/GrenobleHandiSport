<?php
session_start();

require_once('squelette.view.php');

if (isset($_SESSION['user'])) {
  $connecte = true;
}else {
  $connecte = false;
}

$squelette = new squelette('stylesheet.css',$connecte,'info');
echo "$squelette->header"; //HEAD + HEADER + BALISE BODY OUVRANTE

 ?>

 <!-- ================================================ -->
 <!-- ================================================ -->


<div class="body">

  <h2>Informations à propos de ce site :</h2>

<p>Ce site web a été réalisé dans le cadre du Mini-Projet de PHP (TP 6 : Analyse, conception et réalisation d'un site Web Commercial
) du module M3104 - Programmation Web Coté Serveur du semestre 3 de DUT Informatique de L'IUT2 de Grenoble qui se déroule sur 2 semaines.
<br> Pour nous aider à réaliser ce site, nous nous sommes servis des images des création de la tante d'un des membres du groupe sur sa page Instagram que vous pouvez retrouver en cliquand sur l'icone situé dans le footer. Nous la remercions pour son aide.
<br> <br> MAKRI Hamza
<br> ESTEVES-AUDAS Matthias
<br> S3dA2 - 2019/2020  </p>


<!-- ================================================ -->
<!-- ================================================ -->

<?php

echo "$squelette->footer"; //FOOTER + BALISE BODY FERMANTE

 ?>
