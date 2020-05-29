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


  <h1> Page d'ajout d'article dans actualité</h1>

  <?php if ((isset($_GET['valide']))): ?>
    <?php if ($_GET['valide'] == 'oui'): ?>
      <h3>L'article a été ajouté !</h3>
    <?php endif; ?>
  <?php endif; ?>

  <div class="newArticle">
    <form  action="../controler/communication.ctrl.php" method="POST" enctype="multipart/form-data">
      <label for="ftitre">Titre :</label><br>
      <input id="ftitre" name="titre" type="text" value="" size="30" placeholder="Titre" required="required"/><br>

      <label for="image">Image :</label><br>
      <input id="image" type="file" name="imageArticle" accept="image/*" required="required"/>

      <label for="subject">Texte :</label><br>
      <textarea id="subject" name="texte" placeholder="Ecrire ici le contenu de l'article" rows="10" cols="150" ></textarea><br>

      <input type="submit" value="Submit">
    </form>
  </div>

<?php else: ?>

  <h1>VOUS N'AVEZ PAS LE DROIT D'ACCES A CETTE PAGE !</h1>

<?php endif; ?>

<!-- ================================================ -->
<!-- ================================================ -->

<?php

echo "$squelette->footer"; //FOOTER + BALISE BODY FERMANTE

?>
