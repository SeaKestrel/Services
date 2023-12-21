<?php 
ajouterActiviteHistorique('Affichage des services');

// recupération des services
$services = recupInstances($connexion, "Services");
if($services == null || count($services) == 0) {
	$message = "Aucun service n'a été trouvé.";
}
?>
