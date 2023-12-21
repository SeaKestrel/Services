<?php 
ajouterActiviteHistorique('consultation ajout d\'un service');

$communes = recupCommunes($connexion);
$services = recupInstances($connexion, "Services");
if($services == null || count($services) == 0) {
	$message = "Aucun service n'a été trouvé.";
}
if(isset($_POST['boutonValider'])) { // formulaire soumis
	
	// Récupération des variables
	$values = array(
		'commune' => $_POST['commune'],
		'libellé' => $_POST['libellé'],
		'datedeb' => $_POST['datedeb'],
		'datefin' => $_POST['datefin'],
	);
	$periode = recupPeriode($connexion, $values['datedeb'], $values['datefin']);
	if( $periode == FALSE || count($periode) == 0){ // PAS DE PERIODE EXISTANTE, INSERTION
		$periode = ajouterPeriode($connexion, $values['datedeb'], $values['datefin']);
		if($periode == TRUE) {
			ajouterActiviteHistorique('ajout d\'une période');
		}
	}
	$enregistrement = enregisterService($connexion, $values['libellé'], $values['commune'], $values['datedeb'], $values['datefin']);
	if($enregistrement == TRUE) {
		$notif = "Le service a bien été enregistré !";
	} else {
		$notif = "Le service extiste déjà pour cette période !";
	}
}

?>
