
<?php

require_once('squelette.view.php');


if (isset($_SESSION['user'])) {
  $connecte = true;
}else {
  $connecte = false;
}

$squelette = new squelette('stylesheet2.css',$connecte,'accueil');

echo "$squelette->header"; //HEAD + HEADER + BALISE BODY OUVRANTE

 ?>

 <div class="contenu">
   <h1>Ecole de natation</h1>
   <img src="../view/design/piscine.jpg" alt="Image ecole de natation" style="width:100%; height:430px">
   <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
      et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in repr </p>
</div>


<?php

echo "$squelette->footer"; //FOOTER + BALISE BODY FERMANTE

 ?>
