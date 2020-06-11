<?php
  use PHPMailer\PHPMailer\PHPMailer;

  if (isset($_POST['submit'])){

      $name= $_POST['name'];
      $objet= $_POST['objet'];
      $email= $_POST['email'];
      $message= $_POST['message'];

      require_once "../PHPMailer/PHPMailer.php";
      require_once "../PHPMailer/SMTP.php";
      require_once "../PHPMailer/Exception.php";

      $mail = new PHPMailer();
      $mail->isSMTP();
      $mail->Host = "smtp.gmail.com";
      $mail->SMTPAuth = true;
      $mail->Username = "grenoblehandisportenvoi@gmail.com";
      $mail->Password = 'testEnvoi';
      $mail->Port = 465; //587
      $mail->SMTPSecure = "ssl"; //tls


      $mail->isHTML(true);
      $mail->setFrom($email, $name);
      $mail->addAddress("grenoblehandireception@gmail.com");
      $mail->Subject = $objet;
      $mail->Body = "Vous avez reçu un message de: ".$name."\n Adresse mail: ".$email."\n vous a envoyé ce message: \n\n".$message;

      if ($mail->send()) {
          $status = "success";
          $response = "Email is sent!";
          header("Location: ../index.php?mailsent");
      } else {
          $status = "failed";
          $response = "Erreur: <br><br>" . $mail->ErrorInfo;
      }
    }




?>
