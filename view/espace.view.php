<?php

require_once('squelette.view.php');

if (isset($_SESSION['user'])) {
  $connecte = true;

}else {
  $connecte = false;

}
$statut=$_SESSION['user']->statut;

$squelette = new squelette('stylesheet.css',$connecte,'espacePerso');

echo "$squelette->header"; //HEAD + HEADER + BALISE BODY OUVRANTE

 ?>

 <!-- ================================================ -->
 <!-- ================================================ -->

<?php
echo '
<iframe src="../ztest/public/index.php?statut='.$statut.'" style="border-width:0" width="1200" height="800" frameborder="0" scrolling="no"></iframe>
'
 ?>

 <!-- ================================================ -->
 <!-- ================================================ -->

 <?php

 echo "$squelette->footer"; // BALISE BODY FERMANTE + FOOTER

  ?>
