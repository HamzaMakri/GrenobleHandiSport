<?php

require_once('../framework/view.class.php');
require_once('../model/User.class.php');

session_start();

$view = new View('user.view.php');
$db = new MyDB();
// if(!$db){
//    echo $db->lastErrorMsg();
// } else {
//    echo "Base ouverte OK\n";
// }




// =================================================================== //
// ============================ CONNEXION ============================ //
// =================================================================== //

if (isset($_GET['action']) ) {
  if ($_GET['action'] == 'signin') {
    if (isset($_REQUEST['email'] ) && isset($_REQUEST['password'])) {
      $email=$_REQUEST['email'];
      $password=$_REQUEST['password'];

      // echo "email : $email     //     mdp:       $password";

      $db = new MyDB2();
      // if(!$db){
      //    echo $db->lastErrorMsg();
      // } else {
      //    echo "Base ouverte OK\n";
      // }

      // Verifier que les informations données correspondent aux données de la bdd

      $debMail = substr($email, 0, strpos($email, "@"));
      $finMail = substr($email, strpos($email, "@")+1, strlen($email));

      $result = $db->getPdo()->query("SELECT mdp FROM USER WHERE mail ='".$debMail."@".$finMail."'".';');
      $bddMDP = $result->fetch();


      if ($bddMDP['mdp'] == $password){

        $result = $db->getPdo()->query("SELECT nom FROM USER WHERE mail ='".$debMail."@".$finMail."'".';');
        $bddNom = $result->fetch();

        $result = $db->getPdo()->query("SELECT id FROM USER WHERE mail ='".$debMail."@".$finMail."'".';');
        $bddId = $result->fetch();

        $result = $db->getPdo()->query("SELECT statut FROM USER WHERE mail ='".$debMail."@".$finMail."'".';');
        $bddStatut = $result->fetch();

        $_SESSION['user'] = new User($bddNom['nom'],$email,$bddId['id'],$bddStatut['statut']);
        //var_dump($_SESSION['user']);
        $connexionOK = true;
        header('location: ../controler/main.ctrl.php');
        //var_dump($_SESSION['user']);
      }else{
        $connexionOK = false;
      }
      $view->assign('connexionOK',$connexionOK);
    }
    $db = NULL; // pour fermer la connexion

  }
}

// =================================================================== //
// =================================================================== //

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

// =================================================================== //
// =========================== INSCRIPTION =========================== //
// =================================================================== //




    if (isset($_REQUEST['name'])) {



      $name=$_REQUEST['name'];
      $prenom= $_REQUEST['prenom'];
      $sexe= $_REQUEST['sexe'];
      $datenaiss= $_REQUEST['datenaiss'];
      $adresse= $_REQUEST['adresse'];
      $statut=$_REQUEST['statut'];
      $tel= $_REQUEST['tel'];
      if (isset($_FILES['certif'])) {

        // POUR ENREGISTRER LE DOCUMENT DANS LE SERVEUR :
        $destination = "../data/attestations/";
        $attestationmedicale = basename($_FILES['certif']['name']);
        move_uploaded_file($_FILES['certif']['tmp_name'], $destination . $attestationmedicale);
        //////////////////////////////////////////////////

      }
      $sport= $_REQUEST['sports']; //tableau de plusieurs sports
      $email= $_REQUEST['email'];
      $password= $_REQUEST['password'];
      $profession= $_REQUEST['profession'];
      $nationalite= $_REQUEST['nationalite'];
      if (isset($_REQUEST['handicap'])) {
        $handicap= $_REQUEST['handicap'];
      }




      $db = new MyDB2();
      // if(!$db){
      //    echo $db->lastErrorMsg();
      // } else {
      //    echo "Base ouverte OK\n";
      // }

      //Inserer dans la basse de donnée les informations entrées

      $debMail = substr($email, 0, strpos($email, "@"));
      $finMail = substr($email, strpos($email, "@")+1, strlen($email));


      $result = $db->getPdo()->query("SELECT mail FROM inscription WHERE mail ='".$debMail."@".$finMail."'".';');
      $bddEmail = $result->fetch();

      if($bddEmail['mail'] == $email ){            ///////////////// $bddEmail['email'] ??
        $inscriptionOK = false;
        $view->assign('inscriptionOK',$inscriptionOK);
      }
      else{

        if (isset($attestationmedicale) && isset($handicap)) {

          $sql = "INSERT INTO inscription (sexe,nom,prenom,mail,mdp,dateNaiss,nationalite,profession,tel,adresse,statut,handicap,attestationmedicale) VALUES (:sexe,:nom,:prenom,:mail,:mdp,:dateNaiss,:nationalite,:profession,:tel,:adresse,:statut,:handicap,:attestationmedicale )";
          $result = $db->getPdo()->prepare($sql);
          $result->execute(array(

            ':sexe' => $sexe,
            ':nom' => $name,
            ':prenom' => $prenom,
            ':mail' => $email,
            ':mdp' => $password,
            ':dateNaiss' => $datenaiss,
            ':nationalite' => $nationalite,
            ':profession' => $profession,
            ':tel' => $tel,
            ':adresse' => $adresse,
            ':statut' => $statut,
            ':handicap' => $handicap,
            ':attestationmedicale' => $attestationmedicale
          ));

        } elseif (isset($attestationmedicale)) {


          $sql = "INSERT INTO inscription (sexe,nom,prenom,mail,mdp,dateNaiss,nationalite,profession,tel,adresse,statut,attestationmedicale) VALUES (:sexe,:nom,:prenom,:mail,:mdp,:dateNaiss,:nationalite,:profession,:tel,:adresse,:statut,:attestationmedicale )";
          $result = $db->getPdo()->prepare($sql);
          $result->execute(array(
            ':sexe' => $sexe,
            ':nom' => $name,
            ':prenom' => $prenom,
            ':mail' => $email,
            ':mdp' => $password,
            ':dateNaiss' => $datenaiss,
            ':nationalite' => $nationalite,
            ':profession' => $profession,
            ':tel' => $tel,
            ':adresse' => $adresse,
            ':statut' => $statut,
            ':attestationmedicale' => $attestationmedicale
          ));

        }else {
          $sql = "INSERT INTO inscription (sexe,nom,prenom,mail,mdp,dateNaiss,nationalite,profession,tel,adresse,statut,handicap) VALUES (:sexe,:nom,:prenom,:mail,:mdp,:dateNaiss,:nationalite,:profession,:tel,:adresse,:statut,:handicap)";
          $result = $db->getPdo()->prepare($sql);
          $result->execute(array(

            ':sexe' => $sexe,
            ':nom' => $name,
            ':prenom' => $prenom,
            ':mail' => $email,
            ':mdp' => $password,
            ':dateNaiss' => $datenaiss,
            ':nationalite' => $nationalite,
            ':profession' => $profession,
            ':tel' => $tel,
            ':adresse' => $adresse,
            ':statut' => $statut,
            ':handicap' => $handicap
          ));
        }

        // FAIRE UN SELECT DU NUM d'INSCRIPTION
        $result = $db->getPdo()->query("SELECT MAX(numInscript) FROM inscription ");
        $num = $result->fetch();
        $num = $num['MAX(numInscript)'];


        foreach ($sport as $value) {
          $sql2 = "INSERT INTO inscriptionsport (nomsport, numInscript) VALUES (:nomsport, :numInscript)";
          $result = $db->getPdo()->prepare($sql2);
          $result->execute(array(
            ':nomsport' => $value,
            ':numInscript' => $num
          ));
        }

        $inscriptionOK = true;
        //header('location: ../controler/user.ctrl.php?insc=ok');
      }
      $db = NULL; // pour fermer la connexion
    }


// =================================================================== //
// =================================================================== //



$view->display('user.view.php');




?>
