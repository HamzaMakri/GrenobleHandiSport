<?php

require_once('squelette.view.php');

if (isset($_SESSION['user'])) {
  $connecte = true;
}else {
  $connecte = false;
}

$squelette = new squelette('stylesheet.css',$connecte,'actu');

echo "$squelette->header"; //HEAD + HEADER + BALISE BODY OUVRANTE

?>

<!-- ================================================ -->
<!-- ================================================ -->

<h1> L'actualité à Grenolble Handisport </h1>

<?php foreach ($articles as $key => $value): ?>

  <div class="ligne">
    <?php
    $case = $value->getcorps();
    echo "$case";
    ?>

  </div>

<?php endforeach; ?>




<!-- ================================================ -->
<!-- ================================================ -->

<?php

echo "$squelette->footer"; //FOOTER + BALISE BODY FERMANTE

?>
