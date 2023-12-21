<?php
// index.php fait office de controleur frontal
session_start(); // démarre ou reprend une session
ini_set('display_errors', 1); // affiche les erreurs (au cas où)
ini_set('display_startup_errors', 1); // affiche les erreurs (au cas où)
error_reporting(E_ALL); // affiche les erreurs (au cas où)
require('inc/routes.php'); // fichiers de routes
require('inc/includes.php'); // inclut des informations du site (nom, slogan)
require('inc/config-bd.php'); // fichier de configuration d'accès à la BD
require_once('modele/modele.php'); // inclut le fichier modele

$connexion = getConnexionBD(); // connexion à la BD
?>
<!DOCTYPE html>
<html onload="test()">
<head>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<!-- le titre du document, qui apparait dans l'onglet du navigateur -->
    <title><?= $nomSite ?></title>
    <!-- lie le style CSS externe  -->
    <!-- <link href="<?= $styleCSS ?>" rel="stylesheet" media="all" type="text/css"> -->
    <!-- ajoute une image favicon (dans l'onglet du navigateur) -->
    <link rel="shortcut icon" type="image/x-icon" href="img/hotel.png" />
    <style>
    	<?php include($styleCSS); ?>
    </style>
</head>
<body>
    <?php include($pathHeader); ?> <!-- include pour le heazder -->
	<main>
		<?php
		$controleur = $controleurAccueil; // par défaut, on charge la page d'accueil
		$vue = $vueAccueil; // par défaut, on charge la page d'accueil
		if(isset($_GET['page'])) {
			$nomPage = $_GET['page'];
			if(isset($routes[$nomPage])) { // si la page existe dans le tableau des routes, on la charge
				$controleur = $routes[$nomPage]['controleur'];
				$vue = $routes[$nomPage]['vue'];
			} else {
				$nomPage = 'Acceuil';
			}
		}
		include('controleurs/' . $controleur . '.php');
		include('vues/' . $vue . '.php');
		?>
	</main>
    <?php include($pathFooter); ?> <!-- include pour le footer -->
    <?php if(isset($notif)) { ?>
		<div class="notif" open>
			<p><?= $notif ?></p>
		</div>
	<?php } ?>
	<script> // script pour le responsive mobile
		var button = document.querySelector(".shownav");
		
		const menu = document.querySelector(".navbar");
		menu.style.display = "block";
		window.addEventListener("load", test());
		function afficheMenu (){
			console.log(menu.style.display);
			if(menu.style.display == "block"){
				menu.style.display = "none";
			} else {
				menu.style.display = "block";
			}
		}
		
		button.addEventListener("click", afficheMenu);

		function test(){
			console.log(document.body.clientWidth)
			if(document.body.clientWidth < 1000) {
				menu.style.display ="none";
			}
		}
</script>
</body>
</html>
