<?php
ajouterActiviteHistorique('Consultation ajout d\'une periode d\'essai');
$connexion = getConnexionBD(); // connexion à la BD

$departements = recupInstances($connexion, "Départements");

if(isset($_POST['boutonValider'])) {
	$departement = $_POST['departement']=="none"?NULL:$_POST['departement'];
	$dureemax = $_POST['dureemax'];
	$km = isset($_POST['kilometre'])?0:intval($_POST['kilometre']);
	$tab = generPeriodeEssai($connexion, $departement);
}

if(isset($tab)){
	$notif = $tab[0]." services ont été ajoutés.";
}

function generPeriodeEssai($connexion, $nDep){
	$communes = recupCommunesRandom($connexion, $nDep);
	$duree = 0;
	$nbPeriodeAjoutee = 0;
	$resultat = array();
	$tab = array();
	foreach($communes as $c)
	{
		$nServices = rand(3,5);
		$services = recupServiceRandom($connexion, $nServices);
		foreach($services as $service)
		{
			$today = date("Y-m-d");
			$end  = date("Y-m-d", mktime(0, 0, 0, date("m")+randomDuree(), date("d"),   date("Y")));
			ajouterPeriode($connexion,$today, $end);
			enregisterService($connexion, $service["libellé"], $c["idC"], $today, $end);
			$nbPeriodeAjoutee++;
			array_push($tab, array("commune" => $c['idC'], "service" => $service["libellé"], 'deb' => $today, 'fin' => $end));
		}
	}
	array_push($resultat, $nbPeriodeAjoutee);
	array_push($resultat, $tab);
	return $resultat;
}
?>
