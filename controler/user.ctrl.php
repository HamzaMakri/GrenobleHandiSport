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

      $db = new MyDB();
      // if(!$db){
      //    echo $db->lastErrorMsg();
      // } else {
      //    echo "Base ouverte OK\n";
      // }

      // Verifier que les informations données correspondent aux données de la bdd

      $debMail = substr($email, 0, strpos($email, "@"));
      $finMail = substr($email, strpos($email, "@")+1, strlen($email));

      $result = $db->query("SELECT mdp FROM USER WHERE email ='".$debMail."@".$finMail."'".';');
      $bddMDP = $result->fetchArray();

      if ($bddMDP[0] == $password){

        $result = $db->query("SELECT nom FROM USER WHERE email ='".$debMail."@".$finMail."'".';');
        $bddNom = $result->fetchArray();

        $result = $db->query("SELECT id FROM USER WHERE email ='".$debMail."@".$finMail."'".';');
        $bddId = $result->fetchArray();

        $result = $db->query("SELECT statut FROM USER WHERE email ='".$debMail."@".$finMail."'".';');
        $bddStatut = $result->fetchArray();

        $_SESSION['user'] = new User($bddNom[0],$email,$bddId[0],$bddStatut[0]);
        //var_dump($_SESSION['user']);
        $connexionOK = true;
        header('location: ../controler/main.ctrl.php');
        //var_dump($_SESSION['user']);
      }else{
        $connexionOK = false;
      }
      $view->assign('connexionOK',$connexionOK);
    }
    $db->close();

  }
}

// =================================================================== //
// =================================================================== //

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

// =================================================================== //
// =========================== INSCRIPTION =========================== //
// =================================================================== //

if (isset($_GET['action']) ) {
  if ($_GET['action'] == 'signup') {
    if (isset($_REQUEST['name']) && isset($_REQUEST['age']) && isset($_REQUEST['email'] ) && isset($_REQUEST['password'])) {

      $name=$_REQUEST['name'];
      $age=$_REQUEST['age'];
      $email=$_REQUEST['email'];
      $password=$_REQUEST['password'];
      $statut=$_REQUEST['statut'];


      // echo "nom : $name  //  age : $age    //  email : $email     //     mdp:       $password";

      $db = new MyDB();
      // if(!$db){
      //    echo $db->lastErrorMsg();
      // } else {
      //    echo "Base ouverte OK\n";
      // }

      //Inserer dans la basse de donnée les informations entrées

      $debMail = substr($email, 0, strpos($email, "@"));
      $finMail = substr($email, strpos($email, "@")+1, strlen($email));


      $result = $db->query("SELECT email FROM USER WHERE email ='".$debMail."@".$finMail."'".';');
      $bddEmail = $result->fetchArray();
      //var_dump($bddEmail[0]);

      if($bddEmail[0] == $email ){
        $inscriptionOK = false;
        $view->assign('inscriptionOK',$inscriptionOK);
      }
      else{
        $result = $db->query("SELECT id FROM user ORDER BY id DESC LIMIT 1;");
        $idmax = $result->fetchArray();

        $sql =<<<EOF
        INSERT INTO user (ID,NOM,AGE,EMAIL,MDP,STATUT)
        VALUES ($idmax[0]+1, '$name', '$age', '$email', '$password', '$statut' );
        EOF;
        $ret = $db->exec($sql);
        if(!$ret){
          echo $db->lastErrorMsg();
        } else {
          // echo "OK\n";
        }
        $inscriptionOK = true;
        header('location: ../controler/user.ctrl.php?insc=ok');
      }
      $db->close();
    }
  }
}

// =================================================================== //
// =================================================================== //



$view->display('user.view.php');




?>
