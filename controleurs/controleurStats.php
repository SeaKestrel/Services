<?php 
ajouterActiviteHistorique('affichage des statistiques');

// recupération des inscriptions
$inscriptions = recupInscriptions($connexion);
if($inscriptions == null || count($inscriptions) == 0) {
	$mErrInscription = "Aucune inscription n'a été trouvée.";
} else {
	
}

// recupération des stats
$stats = recupStats($connexion);
if($stats == null || count($stats) == 0) {
	$message = "Aucune statistique n'a été trouvée.";
} else {
	
}

$topdepartement = recupTopDep($connexion);
if($topdepartement == null || count($topdepartement) == 0) {
	$mErrTopDep = "Aucun top département n'a été trouvé";
}

$cantines = recupCant($connexion);
if($cantines == null || count($cantines) == 0) {
	$mErrCant = "Aucune inscription à la cantine n'a été trouvé";
}

$inscriptionscommunes = recupInscriptionsMemeNom($connexion);
if($inscriptionscommunes == null || count($inscriptionscommunes) == 0) {
	$mErrMmInscriptions = "Aucune inscription similaire n'a été trouvée n'a été trouvé";
}

$topunions = recupTopUnions($connexion);
if($topunions == null || count($topunions) == 0) {
	$mErrTopUnions = "Aucun union n'a été trouvé";
}

$topservices = recupTopServices($connexion);
if($topservices == null || count($topservices) == 0) {
	$mErrSer = "Aucune service n'est proposé";
}

$topdem = recupTopDemandes($connexion);
if($topdem == null || count($topdem) == 0) {
	$mErrDem = "Aucune demande n'est faite";
}
?>
