<?php

require_once('squelette.view.php');

if (isset($_SESSION['user'])) {
  $connecte = true;
}else {
  $connecte = false;
}

$squelette = new squelette('stylesheet.css',$connecte,'user');

echo "$squelette->header"; //HEAD + HEADER + BALISE BODY OUVRANTE

?>

<!-- ================================================ -->
<!-- ================================================ -->

<?php if ($connecte): ?>
  <h1>VOUS ETES DEJA CONNECTE !</h1>
<?php else: ?>


  <div class="sign">

    <a href="user.ctrl.php?action=signin" class="in"><i class="fa fa-sign-in"></i> Se connecter</a>
    <a href="user.ctrl.php?action=signup" class="up"><i class="fa fa-user-plus"></i> S'inscrire</a>


  </div>

  <?php

  if (isset($_GET['action']) ) {
    if ($_GET['action'] == 'signin') {

      echo '
      <br>
      <p> <b> =============== test de la connexion :  admin@mail.com // mdp : azerty (admin) =============== </b> <p>
      <p> <b> =============== test de la connexion :  adherent@mail.com // mdp : azerty (adherent) =============== </b> <p>
      <br>

      <form  action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="action" value="submit" required="required">

      Votre email:<br>
      <input name="email" type="email" value="" size="30" required="required"><br>

      Votre mot de passe:<br>
      <input name="password" type="password" value="" size="30" required="required"><br><br><br>

      <input type="submit" value="Submit"/>
      </form>

      ';

      if (isset($connexionOK)) {
        if ($connexionOK) {
          echo "<p>Vous êtes connecté </p>";
        }else {
          echo "<p>Ce compte n'existe pas, veuillez réessayer ou faire une demande d'inscription </p>";
        }
      }
    }
  }

  if (isset($_GET['insc'])) {
    if ($_GET['insc'] == 'ok') {
      $inscriptionOK = true;
    }
  }


  if (isset($inscriptionOK)) {
    if ($inscriptionOK) {
      echo "<p>Votre inscription est validé </p>";
    }else {
      echo "<p>Un compte est déjà lié à cette adresse mail, veuillez vous connecter ou saisir un autre mail</p>";
    }
  }


  if (isset($_GET['action']) ) :
    if ($_GET['action'] == 'signup'): ?>

    <p>Veuillez renseigner vos informations dans les champs ci-dessous et joindre les documents nécessaire, nous vous assurons la confidentialité de vos informations et la protection de vos données. Une fois ce formulaire remplis, nous vous recontacterons afin de prendre rendez-vous et finaliser l’inscription</p> <br>

    <br>

    <p> <b> =============== tel quel, la page d\'inscription crée directement un compte =============== </b> <p>

      <br>


      <form  action="../controler/user.ctrl.php?action=signup" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="submit" required="required">

        <fieldset>

          <legend>INFORMATIONS PERSONNELLES</legend>

          <label for="name">Nom :</label>
          <input id="name" name="name" type="text"  size="30" required="required"/><br>

          <label for="prenom">Prenom :</label>
          <input id="prenom" name="prenom" type="text" size="30" required="required"/><br>

          <label for="sexe">Sexe :</label>
          <input type="radio" id="homme" name="sexe" value="h" checked>
          <label for="homme">Homme</label>
          <input type="radio" id="femme" name="sexe" value="f">
          <label for="femme">Femme</label><br>

          <label for="datenaiss">Date de naissance :</label>
          <input name="datenaiss" type="date" size="30" required="required"/><br>

          <label for="nationalite">Nationalité :</label>
          <input id="nationalite" name="nationalite" type="text" size="30" required="required"/><br>

          <label for="profession">Profession :</label>
          <input id="profession" name="profession" type="text" size="30" required="required"/><br>

          <label for="handicap">Handicap (vous n'êtes pas obligé de renseigner cette information) :</label>
          <input id="handicap" name="handicap" type="text" size="30"/><br>

          <label for="adresse">Adresse postale complete :</label>
          <input type="text" name="adresse" size="100" required><br>

          <label for="statut">Statut :</label>
          <input type="radio" id="adh" name="statut" value="adherent" required checked>
          <label for="adh">Ahdérent</label>
          <input type="radio" id="bene" name="statut" value="benevole">
          <label for="bene">Bénévole</label><br>

          <label for="tel">Numero de téléphone:</label>
          <input type="tel" id="tel" name="tel" pattern="[0-9]{10}" required> <br>

          <label for="certif">Certificat médical  :</label>
          <input id="certif" type="file" name="certif" accept="image/*|.pdf" required="required"/>

        </fieldset>

        <fieldset>

          <legend>SPORTS</legend>

          <fieldset>

            <legend>En loisir</legend>

            <label for="escrimeloisir">
              <input type="checkbox" id="escrimeloisir" name="sports[]" value="escrimeloisir"> Escrime en loisir
            </label><br>

            <label for="hockeyloisir">
              <input type="checkbox" id="hockeyloisir" name="sports[]" value="hockeyloisir"> Hockey Fauteuil en loisir
            </label><br>

            <label for="natationloisir">
              <input type="checkbox" id="natationloisir" name="sports[]" value="natationloisir">  Natation en loisir
            </label><br>

            <label for="skiloisir">
              <input type="checkbox" id="skiloisir" name="sports[]" value="skiloisir"> Ski Alpin en loisir
            </label><br>

            <label for="tennisloisir">
              <input type="checkbox" id="tennisloisir" name="sports[]" value="tennisloisir"> Tennis en loisir
            </label><br>

            <label for="torballloisir">
              <input type="checkbox" id="torballloisir" name="sports[]" value="torballloisir"> Torball en loisir
            </label><br>

          </fieldset>

          <fieldset>

            <legend>En competition</legend>

            <label for="escrimecompet">
              <input type="checkbox" id="escrimecompet" name="sports[]" value="escrimecompet"> Escrime en compétition
            </label><br>

            <label for="hockeycompet">
              <input type="checkbox" id="hockeycompet" name="sports[]" value="hockeycompet"> Hockey Fauteuil en compétition
            </label><br>

            <label for="natationcompet">
              <input type="checkbox" id="natationcompet" name="sports[]" value="natationcompet"> Natation en compétition
            </label><br>

            <label for="skicompet">
              <input type="checkbox" id="skicompet" name="sports[]" value="skicompet"> Ski Alpin en compétition
            </label><br>

            <label for="tenniscompet">
              <input type="checkbox" id="tenniscompet" name="sports[]" value="tenniscompet"> Tennis en compétition
            </label><br>

            <label for="torballcompet">
              <input type="checkbox" id="torballcompet" name="sports[]" value="torballcompet"> Torball en compétition
            </label><br>

          </fieldset>

        </fieldset>

        <fieldset>
          <legend>IDENTIFIANTS ET MOT DE PASSE</legend>
          <label for="email">Mail :</label>
          <input name="email" type="email" size="30" required="required"/><br>

          <label for="password">Mot de passe :</label>
          <input name="password" type="password" value="" size="30" required="required"/><br><br><br>
        </fieldset>

        <input type="submit" value="Valider"/>

      </form>


      <?php
    endif;
  endif;

  ?>

<?php endif; ?>





<!-- ================================================ -->
<!-- ================================================ -->

<?php

echo "$squelette->footer"; // BALISE BODY FERMANTE + FOOTER

?>
