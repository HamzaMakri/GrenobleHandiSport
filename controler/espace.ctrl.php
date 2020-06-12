<?php

require_once('../framework/view.class.php');
require_once('../model/User.class.php');



session_start();


if (isset($_GET['action'])) {
  if ($_GET['action'] == 'logout') {
    session_destroy();
    $view = new View('acceuil.view.php');
    $view->display("acceuil.view.php");
    //header('location: ../controler/user.ctrl.php');
  }
}else{

  $view = new View('espace.view.php');

  $view->display("espace.view.php");
}

 ?>
