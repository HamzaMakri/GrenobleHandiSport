<?php

require_once('squelette.view.php');


if (isset($_SESSION['user'])) {
  $connecte = true;
}else {
  $connecte = false;
}

$squelette = new squelette('contact.css',$connecte,'accueil');

echo "$squelette->header"; //HEAD + HEADER + BALISE BODY OUVRANTE

 ?>

<main>
  <p>Contactez-nous par e-mail</p>
  <form class="contact-form" action="../controler/mail.ctrl.php" method="post">
    <input type="text" name="name" placeholder="Votre nom complet">
    <input type="text" name="mail" placeholder="Votre E-mail">
    <input type="text" name="objet" placeholder="Objet de votre message">
    <textarea name="message" placeholder="Votre message"></textarea>
    <button type="submit" name="submit">Envoyer l'E-mail</button>
  </form>
</main>


 <?php

 echo "$squelette->footer"; //FOOTER + BALISE BODY FERMANTE

  ?>
