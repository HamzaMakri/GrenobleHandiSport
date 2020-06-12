<?php

require_once('squelette.view.php');
require_once('../model/User.class.php');

session_start();


if (isset($_SESSION['user'])) {
  $connecte = true;
}else {
  $connecte = false;
}

$squelette = new squelette('stylesheet.css',$connecte,'espacePerso');

echo "$squelette->header"; //HEAD + HEADER + BALISE BODY OUVRANTE

?>
<h1>Liste des utilisateurs du site</h1>
<table align=center border="1px" style="width:600px; line-height:40px;">
  <tr>
    <th>Identifiant</th>
    <th>Nom</th>
    <th>Prénom</th>
    <th>E-Mail</th>
    <th>Statut</th>
  </tr>
  <?php
    $connec= mysqli_connect('localhost','root','','grenoblehandisport');
    $sql="SELECT id,nom,prenom,mail,statut FROM user; ";
    $result = $connec->query($sql);

    if($result->num_rows > 0){
      while($row= $result->FETCH_ASSOC()){
        echo "<tr><td>".$row['id']."</td><td>".$row['nom']."</td><td>".$row["prenom"]."</td><td>".$row["mail"]."</td><td>".$row["statut"]."</td></tr>";
      }
    }
    else{
      echo "Aucun utilisateur enregistré";
    }
  ?>
</table>


 <?php

 echo "$squelette->footer"; //FOOTER + BALISE BODY FERMANTE

  ?>
