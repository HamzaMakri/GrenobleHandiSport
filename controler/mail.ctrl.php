<?php
if (isset($_POST['submit'])){
  $name= $_POST['name'];
  $objet= $_POST['objet'];
  $mail= $_POST['mail'];
  $message= $_POST['message'];

  $mailTO = "grenoblehandisportenvoi@gmail.com";
  $headers = "From: ".$mail;
  $txt= "Vous avez reçu un e-mail de : ".$name.".\n\n".$message;

  if(mail($mailTO, $objet, $txt, $headers)){
    header("Location: ../index.php?mailsent");
  }
  else{
    echo"échec de l'envoi de l'e_mail";
  }
}


?>
