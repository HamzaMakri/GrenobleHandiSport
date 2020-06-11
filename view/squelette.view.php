<?php


class squelette{

  public $header;
  public $footer;
  public $navbar;

  function __construct($css,$connecte,$page) {

    $bouton;
    $inscription;
    $deconnexion;
    $menuInscription = '';
    $footerInscription = '';
    $titre = '<h1>GRENOBLE HANDISPORT</h1>
              <h2>________</h2>
              <h3>Le sport pour tous</h3>';
    $infoUser = '';
    $deconnexion='';
    $navbarAccueil = '
        <div class="navbar">
        <ul>
        <li><a href="../controler/main.ctrl.php">ACCUEIL</a></li>
        <li><a href="#" aria-haspopup="true">LA VIE AU CLUB</a>
        <ul class="dropdown" aria-label="submenu">
        <li><a href="#">HISTORIQUE</a></li>
        </ul>
        </li>
        <li><a href="#" aria-haspopup="true">SPORTS</a>
        <ul class="dropdown" aria-label="submenu">
        <li><a href="../view/hockey.view.php">HOCKEY</a></li>
        <li><a href="escrime.view.php">ESCRIME</a></li>
        <li><a href="../view/paratennis.view.php">PARATENNIS</a></li>
        <li><a href="../view/torball.view.php">TORBALL</a></li>
        <li><a href="#">NATATION</a>
        <ul class="dropdown2" aria-label="submenu">
        <li><a href="../view/ecole_natation.view.php">ECOLE DE NATATION</a></li>
        <li><a href="../view/natation_adulte.view.php">NATATION ADULTE (HANDI NATATION)</a></li>
        </ul>
        </li>
        <li><a href="../view/ski.view.php">SKI ALPIN</a></li>
        </ul>
        </li>
        '.$menuInscription.'
        <li><a href="../controler/actu.ctrl.php" aria-haspopup="true">ACTUALITES</a></li>
        <li><a href="../view/contact.view.php" aria-haspopup="true">CONTACT</a></li>
        <li><a href="#" aria-haspopup="true">COMMENT NOUS AIDER</a></li>
        </ul>
        </div>';


//
// ===================================== AFFICHAGE QUAND PAS CONNECTE =====================================
//
    if (!$connecte) {

      $footerInscription = '<li><a href="../controler/user.ctrl.php?action=signup" aria-haspopup="true">S\'inscrire</a></li>';
      $menuInscription = '<li><a href="../controler/user.ctrl.php?action=signup" aria-haspopup="true">S\'INSCRIRE</a></li>';
      $bouton = '
      <p>
        <a href="../controler/user.ctrl.php?action=signin" class="login">Se connecter</a>
      </p>
      ';

      $inscription ='
      <p>
        <a href="../controler/user.ctrl.php?action=signup" class="insc">S\'inscrire</a>
      </p>
      ';
      $this->navbar = '
          <div class="navbar">
          <ul>
          <li><a href="../controler/main.ctrl.php">ACCUEIL</a></li>
          <li><a href="#" aria-haspopup="true">LA VIE AU CLUB</a>
          <ul class="dropdown" aria-label="submenu">
          <li><a href="#">HISTORIQUE</a></li>
          </ul>
          </li>
          <li><a href="#" aria-haspopup="true">SPORTS</a>
          <ul class="dropdown" aria-label="submenu">
          <li><a href="../view/hockey.view.php">HOCKEY</a></li>
          <li><a href="escrime.view.php">ESCRIME</a></li>
          <li><a href="../view/paratennis.view.php">PARATENNIS</a></li>
          <li><a href="../view/torball.view.php">TORBALL</a></li>
          <li><a href="#">NATATION</a>
          <ul class="dropdown2" aria-label="submenu">
          <li><a href="../view/ecole_natation.view.php">ECOLE DE NATATION</a></li>
          <li><a href="../view/natation_adulte.view.php">NATATION ADULTE (HANDI NATATION)</a></li>
          </ul>
          </li>
          <li><a href="../view/ski.view.php">SKI ALPIN</a></li>
          </ul>
          </li>
          '.$menuInscription.'
          <li><a href="../controler/actu.ctrl.php" aria-haspopup="true">ACTUALITES</a></li>
          <li><a href="../view/contact.view.php" aria-haspopup="true">CONTACT</a></li>
          <li><a href="#" aria-haspopup="true">COMMENT NOUS AIDER</a></li>
          </ul>
          </div>';
    }

//
// ===================================== AFFICHAGE QUAND CONNECTE =====================================
//
    else {
      $bouton = '
      <form action="../controler/espace.ctrl.php">
          <button class="espacePerso"><i class="fa fa-user"></i>Espace personnel</button>
      </form>
      ';
      $deconnexion= '
      <p>
        <a href="../controler/espace.ctrl.php?action=logout" class="deco">Se déconnecter</a>
      </p>
      ';
      $inscription='';

      //------- SI ON EST SUR LA PAGE "ESPACE PERSONNEL" --------
      if ($page == 'espacePerso') {

        $infoUser = '
        <div class="infoUser">
          <h4> '.$_SESSION['user']->nom.' <h4>
          <h5> '.$_SESSION['user']->statut.' <h5>
        </div>
        ';


        switch ($_SESSION['user']->statut) {
          case 'admin':
            $titre = '<h1>ESPACE GESTION</h1>';
            $this->navbar = '
            <div class="navbar">
            <ul>
            <li><a href="../controler/main.ctrl.php">ACCUEIL</a></li>
            <li><a href="../ztest/public/index.php">AGENDA</a></li>
            <li><a href="../controler/communication.ctrl.php">COMMUNICATION</a></li>
            <li><a href="../controler/demandes.ctrl.php" aria-haspopup="true">DEMANDES D\'INSCRIPTION</a></li>
            <li><a href="../view/utilisateurs.view.php">UTILISATEURS</a></li>
            </ul>
            </div>';
          break;
          case 'adherent':
            $titre = '<h1>ESPACE PERSONNEL</h1>';
            $this->navbar = '
            <div class="navbar">
            <ul>
            <li><a href="../controler/main.ctrl.php">ACCUEIL</a></li>
            <li><a href="../ztest/public/index.php">AGENDA</a></li>
            <li><a href="../controler/actu.ctrl.php">ACTUALITES</a></li>
            <li><a href="#" aria-haspopup="true">CONTACT</a></li>
            </ul>
            </div>';
          break;
          case 'benevole':
            $titre = '<h1>ESPACE PERSONNEL</h1>';
            $this->navbar = '
            <div class="navbar">
            <ul>
            <li><a href="../controler/main.ctrl.php">ACCUEIL</a></li>
            <li><a href="../ztest/public/index.php">AGENDA</a></li>
            <li><a href="../controler/actu.ctrl.php">ACTUALITES</a></li>
            <li><a href="#" aria-haspopup="true">CONTACT</a></li>
            </ul>
            </div>';
        }

      }
      else {
        $this->navbar = '
            <div class="navbar">
            <ul>
            <li><a href="../controler/main.ctrl.php">ACCUEIL</a></li>
            <li><a href="#" aria-haspopup="true">LA VIE AU CLUB</a>
            <ul class="dropdown" aria-label="submenu">
            <li><a href="#">HISTORIQUE</a></li>
            </ul>
            </li>
            <li><a href="#" aria-haspopup="true">SPORTS</a>
            <ul class="dropdown" aria-label="submenu">
            <li><a href="../view/hockey.view.php">HOCKEY</a></li>
            <li><a href="escrime.view.php">ESCRIME</a></li>
            <li><a href="../view/paratennis.view.php">PARATENNIS</a></li>
            <li><a href="../view/torball.view.php">TORBALL</a></li>
            <li><a href="#">NATATION</a>
            <ul class="dropdown2" aria-label="submenu">
            <li><a href="../view/ecole_natation.view.php">ECOLE DE NATATION</a></li>
            <li><a href="../view/natation_adulte.view.php">NATATION ADULTE (HANDI NATATION)</a></li>
            </ul>
            </li>
            <li><a href="../view/ski.view.php">SKI ALPIN</a></li>
            </ul>
            </li>
            '.$menuInscription.'
            <li><a href="../controler/actu.ctrl.php" aria-haspopup="true">ACTUALITES</a></li>
            <li><a href="../view/contact.view.php" aria-haspopup="true">CONTACT</a></li>
            <li><a href="#" aria-haspopup="true">COMMENT NOUS AIDER</a></li>
            </ul>
            </div>';

      }

    }



//
// ===================================== HEADER =====================================
//

    $this->header = '

    <html lang="fr">
    <head>
      <title>Accueil - Grenoble Handisport</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="http://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="../view/design/'.$css.'">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
      <link rel="icon" type="image/png" href="../view/design/Favicon.jpg" />
    </head>

    <header>

      <div class="titre">
      '.$titre.'

      </div>'

      .$infoUser
      .$deconnexion
      .$this->navbar.'

    </header>

  <body>
'.$inscription.'
'.$bouton.'


    ';


//
// ===================================== FOOTER =====================================
//

    $this->footer = '
      </body>
      <footer>
        <div class="footer">
          <a href="https://www.facebook.com/Grenoble-Handisport-463785720310888/" class="fa fa-facebook"></a>
          <a href="https://www.instagram.com/grenoble_handisport/?hl=fr" class="fa fa-instagram"></a>
          <ul>
            <li><a href="../controler/main.ctrl.php">Accueil</a></li>
            <li><a href="#">La vie du club</a></li>
            <li><a href="#">Sports</a></li>
            '.$footerInscription.'
            <li><a href="../controler/user.ctrl.php">Actualités</a></li>
            <li><a href="../view/contact.view.php">Contact</a></li>
            <li><a href="#">Comment nous aider</a></li>
          </ul>
        <p>Copyright © 2020 Grenoble Handisport. All rights reserved.</p>
        </div>
      </footer>
      </html>
      ';
  }
}



 ?>
