<?php

require_once('squelette.view.php');


if (isset($_SESSION['user'])) {
  $connecte = true;
}else {
  $connecte = false;
}

$squelette = new squelette('stylesheet.css',$connecte,'espacePerso');

echo "$squelette->header"; //HEAD + HEADER + BALISE BODY OUVRANTE
?>

<!-- ================================================ -->
<!-- ================================================ -->


  <?php if ($connecte && $_SESSION['user']->statut == 'admin'): ?>


    <h1> Liste des demandes d'inscription</h1>

    <?php if ((isset($_GET['valide']))): ?>
      <?php if ($_GET['valide'] == 'oui'): ?>
        <h3>L'article a été ajouté !</h3>
      <?php endif; ?>
    <?php endif; ?>


    <?php
     foreach ($demandes as $key => $value): ?>

      <div class="liste-demandes">
        <?php
        $case = $value->getcorps();
        echo "$case";
        ?>

      </div>

    <?php endforeach; ?>


  <?php else: ?>

    <h1>VOUS N'AVEZ PAS LE DROIT D'ACCES A CETTE PAGE !</h1>

  <?php endif; ?>

  <!-- ================================================ -->
  <!-- ================================================ -->

  <?php

  echo "$squelette->footer"; //FOOTER + BALISE BODY FERMANTE

  ?>
