

<?php
session_start();
/* HEADER entete avec dépendances CSS 
  ================================================== */
include_once __DIR__ . '/Vue/header.php';

/*NAVBAR
    ================================================== */
include_once __DIR__ . '/Vue/menu.php';

/* Carousel
    ================================================== */
include_once __DIR__ . '/Vue/slider.php';

//require("./dao/connection.php");

/*  Marketing mainpage 
    ================================================== 
   Wrap the rest of the page in another container to center all the content. */

echo '<h1>Liste des biens immobiliers</h1>';

echo '<form  action="index.php" method="GET"  enctype="multipart/form-data" >
		<fieldset><legend>Rechercher un Bien immobilier</legend>
			<div class="form-group">
                <input type="hidden" name="lib_cat" value="" id="lib_cat" />
                <label for="dept">Choisir le département</label>';
echo '<select name="dep"  id="dep" class="form-control"  style=" max-width:300px"><option value="">Choisissez votre département</option> ';
echo '</select>';
echo ' </div>
 <div class="form-group">
 
 <label for="budget">Montant budget maximum</label>
 	<span class="currencyinput">€
<input type="number"  step="10000" id="bugdet" name="budget" placeholder="Budget Max"  min="50000" max="900000000" />
</span>
</div>

<div class="form-group">
 <label for="nbpiece" >Nombre de pièces souhaitées:</label>';

echo '<select name="nbpieces"  id="nbre" class="form-control"  style=" max-width:300px"><option value=" " >Choisissez le nombre de pièce</option>';


echo "</select></div>";

echo  '
         <div class="form-group form-button" id="btnsub" >				  
 <button type="submit" class="btn btn-primary" name="envoi">Submit</button>
	</div>
	</fieldset>
	 </form>';


// Contrôleur MVS
require_once __DIR__ . '/Controleur/BiensImmoController.php';
$ctrl = new BiensImmoController();

$action = $_GET['action'] ?? ($_POST['action'] ?? 'liste');

switch ($action) {
    case 'liste':
        $ctrl->afficherTous();
        break;
    default:
        $ctrl->afficherTous();
}

include_once __DIR__ . '/Vue/acces_membre.php';
/* Pied de page avec dépendances Javascript...
    ================================================== */

include_once __DIR__ . '/Vue/footer.php';
?>
          
   


