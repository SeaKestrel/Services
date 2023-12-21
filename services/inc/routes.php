<?php

/*
** Il est possible d'automatiser le routing, notamment en cherchant directement le fichier controleur et le fichier vue.
** ex, pour page=afficher : verification de l'existence des fichiers controleurs/controleurAfficher.php et vues/vueAfficher.php
** Cela impose un nommage strict des fichiers.
*/
$routes = array(
	'stats' => array('controleur' => 'controleurStats', 'vue' => 'vueStats', 'nom' => 'Statistiques', 'id' => 'stats' ),
	'ajouter' => array('controleur' => 'controleurAjouter', 'vue' => 'vueAjouter', 'nom' => 'Ajouter', 'id' => 'ajouter'),
	'afficher' => array('controleur' => 'controleurAfficher', 'vue' => 'vueAfficher', 'nom' => 'Afficher', 'id' => 'afficher'),
	'periodeessai' => array('controleur' => 'controleurPeriodeEssai', 'vue' => 'vuePeriodeEssai', 'nom' => 'Période d\'essai', 'id' => 'periodeessai'),
	'historique' => array('controleur' => 'controleurHistorique', 'vue' => 'vueHistorique', 'nom' => 'Historique', 'id' => 'historique'),
);

// fichiers statiques
$pathHeader = 'static/header.php';
$pathMenu = 'static/menu.php';
$pathFooter = 'static/footer.php';
$controleurAccueil = 'controleurAccueil';
$vueAccueil = 'vueAccueil';
$nomAccueil = 'Accueil';
?>
