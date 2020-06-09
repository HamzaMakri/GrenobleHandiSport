<?php

require_once('squelette.view.php');


if (isset($_SESSION['user'])) {
  $connecte = true;
}else {
  $connecte = false;
}

$squelette = new squelette('contact.css',$connecte,'accueil');

echo "$squelette->header"; //HEAD + HEADER + BALISE BODY OUVRANTE

 ?>



 	<div class="container-contact100">
 		<div class="wrap-contact100">
 			<form class="contact100-form validate-form">
 				<span class="contact100-form-title">
 					Contactez-nous!
 				</span>

 				<div class="wrap-input100 validate-input" data-validate="Name is required">
 					<input class="input100" id="name" type="text" name="name" placeholder="Nom">
 					<label class="label-input100" for="name">
 						<span class="lnr lnr-user"></span>
 					</label>
 				</div>

 				<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
 					<input class="input100" id="email" type="text" name="email" placeholder="Email">
 					<label class="label-input100" for="email">
 						<span class="lnr lnr-envelope"></span>
 					</label>
 				</div>

 				<div class="wrap-input100 validate-input" data-validate = "Phone is required">
 					<input class="input100" id="phone" type="text" name="phone" placeholder="Téléphone">
 					<label class="label-input100" for="phone">
 						<span class="lnr lnr-phone-handset"></span>
 					</label>
 				</div>

 				<div class="wrap-input100 validate-input" data-validate = "Message is required">
 					<textarea class="input100" name="message" placeholder="Votre message..."></textarea>
 				</div>

 				<div class="contact100-form-checkbox">
 					<input class="input-checkbox100" id="ckb1" type="checkbox" name="copy-mail">
 					<label class="label-checkbox100" for="ckb1">
 					     M'envoyer une copie
 					</label>
 				</div>

 				<div class="container-contact100-form-btn">
 					<div class="wrap-contact100-form-btn">
 						<div class="contact100-form-bgbtn"></div>
 						<button class="contact100-form-btn">
 							Envoyer
 						</button>
 					</div>
 				</div>
 			</form>
 		</div>
 	</div>

 <?php

 echo "$squelette->footer"; //FOOTER + BALISE BODY FERMANTE

  ?>
