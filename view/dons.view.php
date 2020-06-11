<?php

require_once('squelette.view.php');


if (isset($_SESSION['user'])) {
  $connecte = true;
}else {
  $connecte = false;
}

$squelette = new squelette('stylesheet.css',$connecte,'accueil');

echo "$squelette->header"; //HEAD + HEADER + BALISE BODY OUVRANTE

 ?>
 <div class="container">
     <div class="row justify-content-center">
         <div class="col-md-6 col-offset-3">
             <div class="card">
                 <div class="card-block text-center">
                     <div class="card-title">
                         Aidez Grenoble Handisport
                     </div>
                     <ul class="list-group">
                         <li class="list-group-item">Nous vous remercions de votre aide</li>
                     </ul>
                     <br><br>
                     <div class="don">
                       <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                       <input type="hidden" name="cmd" value="_s-xclick" />
                       <input type="hidden" name="hosted_button_id" value="45JGPR9PD7SYW" />
                       <input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Bouton Faites un don avec PayPal" />
                       <img alt="" border="0" src="https://www.paypal.com/fr_FR/i/scr/pixel.gif" width="1" height="1" />
                       </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>


 <?php

 echo "$squelette->footer"; //FOOTER + BALISE BODY FERMANTE

 ?>
