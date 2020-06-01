<?php
require_once('../framework/view.class.php');
require_once('../model/User.class.php');
require_once('../model/Article.class.php');

session_start();

$articlesDOA = new ArticleDOA();
$articles = $articlesDOA->getAll();




$view = new View('actu.view.php');

$view->assign('articles',$articles);

$view->display("actu.view.php");
 ?>
