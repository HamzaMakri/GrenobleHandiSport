<?php

require_once('../framework/view.class.php');
require_once('../model/mail.class.php');

session_start();    // pour detruire la session : session_destroy();



$view = new View('contact.view.php');

$view->display("contact.view.php");

 ?>
