<?php 

// connexion à la BD, retourne un lien de connexion
function getConnexionBD() {
	$connexion = mysqli_connect(SERVEUR, UTILISATRICE, MOTDEPASSE, BDD);
	if (mysqli_connect_errno()) {
	    printf("Échec de la connexion : %s\n", mysqli_connect_error());
	    exit();
	}
	mysqli_query($connexion,'SET NAMES UTF8'); // noms en UTF8
	return $connexion;
}

// déconnexion de la BD
function deconnectBD($connexion) {
	mysqli_close($connexion);
}

// nombre d'instances d'une table $nomTable
function compteInstances($connexion, $nomTable) {
	$requete = "SELECT COUNT(*) AS nb FROM $nomTable";
	$res = mysqli_query($connexion, $requete);
	if($res != FALSE) {
		$row = mysqli_fetch_assoc($res);
		return $row['nb'];
	}
	return -1;  // valeur négative si erreur de requête (ex, $nomTable contient une valeur qui n'est pas une table)
}

// retourne les instances d'une table $nomTable
function recupInstances($connexion, $nomTable) {
	$requete = "SELECT * FROM $nomTable";
	$res = mysqli_query($connexion, $requete);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

// retourne les instances des enfants et leur inscription (lien sur idE)
function recupInscriptions($connexion){
	$requeteInscriptions = "SELECT nomE, prénomE, nomL FROM InscriptionEcole NATURAL JOIN Enfants";
	$reponse = mysqli_query($connexion, $requeteInscriptions);
	$instances = mysqli_fetch_all($reponse, MYSQLI_ASSOC);
	return $instances;
}


// retourne le nombre d'inscription (supérieur à 1) correspondant aux enfants qui ont le même nom
function recupInscriptionsMemeNom($connexion)
{
	$req = "SELECT COUNT(DISTINCT idE) as nb, nomE, prénomE FROM InscriptionEcole NATURAL JOIN Enfants GROUP BY nomE, prénomE";
	$res = mysqli_query($connexion, $req);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

// retourne les commmunes ayant le plus d'union lié
function recupTopUnions($connexion)
{
	$req = "SELECT COUNT(DISTINCT typeU, nomCit1, prénomCit1, nomCit2, prénomCit2) as nb, nomCom FROM Unions NATURAL JOIN Communes GROUP BY nomCom ORDER BY nb DESC LIMIT 3";
	$res = mysqli_query($connexion, $req);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

// TOP DES SERVICES LES PLUS PROPOSÉS PAR LES COMMUNES
function recupTopServices($connexion)
{
	$req = "SELECT COUNT(DISTINCT libellé, idC) as nb, libellé FROM ProposerServices GROUP BY libellé ORDER BY nb DESC LIMIT 3";
	$res = mysqli_query($connexion, $req);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

// TOP DES SERVICES LES PLUS DEMANDÉS PAR LES CITOYENS
function recupTopDemandes($connexion)
{
	$req = "SELECT COUNT(DISTINCT idDem) as nb, libellé FROM Demandes GROUP BY libellé ORDER BY nb DESC LIMIT 3";
	$res = mysqli_query($connexion, $req);
	$instances = mysqli_fetch_all($res, MYSQLI_ASSOC);
	return $instances;
}

// Récupère les communes triées par nom (recupInstances renvoyant l'entièreté de la table sans tri)
function recupCommunes($connexion) {
	$requeteCommunes = "SELECT * FROM Communes ORDER BY nomCom";
	$reponse = mysqli_query($connexion, $requeteCommunes);
	$instances = mysqli_fetch_all($reponse, MYSQLI_ASSOC);
	return $instances;
}

// récupèreles stats du nombre d'instances de plusieurs tables
function recupStats($connexion) {
	return array('enfants' => compteInstances($connexion, "Enfants"), 'écoles' => compteInstances($connexion, "Ecoles"), 'inscriptions' => compteInstances($connexion, "InscriptionEcole"));
}

// récupère la période fournie en paramètre 
function recupPeriode($connexion, $datedeb, $datefin)
{
	if($datedeb < $datefin){
		$req = mysqli_query($connexion, "SELECT COUNT(*) as c FROM Périodes WHERE dateDeb =".$datedeb." AND dateFin =".$datefin);
	} else {
		$req = mysqli_query($connexion, "SELECT COUNT(*) as c FROM Périodes WHERE dateDeb =".$datefin." AND dateFin =".$datedeb);
	}
	$res = mysqli_fetch_all($req, MYSQLI_ASSOC);
	$row = mysqli_fetch_assoc($req);
	return $row;
}


// ajoute une nouvelle période dans la base de donnée
function ajouterPeriode($connexion, $datedeb, $datefin)
{
	if(recupPeriode($connexion, $datedeb, $datefin) == FALSE){
		if($datedeb < $datefin){
			$req = "INSERT INTO Périodes (dateDeb, dateFin) VALUES ('".$datedeb."','".$datefin."')";
		} else {
			$req = "INSERT INTO Périodes (dateDeb, dateFin) VALUES ('".$datefin."','".$datedeb."')";
		}

		return mysqli_query($connexion, $req);
	}
	return NULL;
}

// function ajouterService($connexion, $libelle, $payant, $descS)
// {
// 	$libelle = mysqli_real_escape_string($connexion, $libelle); // SÉCURISATION DES VARIABLES
// 	$descS = mysqli_real_escape_string($connexion, $descS);
// 	$requete = "INSERT INTO Services (libellé, payant_, descS) VALUES ('".$libelle."',".($payant=="payant"?1:0) .",'".$descS."')";
// 	return mysqli_query($connexion, $requete);
// }

function enregisterService($connexion, $libelle, $commune, $datedeb, $datefin)
{
	$libelle = mysqli_real_escape_string($connexion, $libelle); // SÉCURISATION DES VARIABLES

	if($datedeb < $datefin)
	{
		$req = "INSERT INTO ProposerServices (idC, libellé, dateDeb, dateFin) VALUES (".$commune.",'".$libelle."','".$datedeb."','".$datefin."')";
	} else {
		$req = "INSERT INTO ProposerServices (idC, libellé, dateDeb, dateFin) VALUES (".$commune.",'".$libelle."','".$datefin."','".$datedeb."')";
	}
	ajouterActiviteHistorique('Ajout du service '.$libelle. ' à la commune '.$commune);
	return mysqli_query($connexion, $req);
}

// récupère les 3 départements ayant le plus de communes
function recupTopDep($connexion)
{
	$req = mysqli_query($connexion,"SELECT nomD, COUNT(DISTINCT idC) AS nbCommunes 
									FROM Départements NATURAL JOIN Communes 
									WHERE codeInseeD IN (SELECT codeInseeD FROM Communes GROUP BY codeInseeD) 
									GROUP BY nomD ORDER BY nbCommunes DESC LIMIT 3");
	$res = mysqli_fetch_all($req, MYSQLI_ASSOC);
	return $res;
}


// récupère les enfants qui mangeront à la cantine le 01-01-2024
function recupCant($connexion)
{
	$req = mysqli_query($connexion,"SELECT idE, nomE, prénomE, nomCant 
									FROM Enfants NATURAL JOIN MangerCantine 
									WHERE idE IN 
										( SELECT idE FROM MangerCantine m WHERE m.dateDeb <= '2024-01-01' AND m.dateFin >= '2024-01-01')");
	$res = mysqli_fetch_all($req, MYSQLI_ASSOC);
	return $res;
}


// récupère entre 5 et 20 communes aléatoires
function recupCommunesRandom($connexion, $nDep) {
	$reqCommunes = mysqli_query($connexion, "SELECT * FROM Communes".($nDep!=0?" WHERE codeInseeD = ".$nDep:"")." ORDER BY RAND() LIMIT ". rand(5,20));
	/*if($nDep == 0){
		$reqCommunes = mysqli_query($connexion, "SELECT * FROM Communes ORDER BY RAND() LIMIT ". rand(5,20));
	} else {
		$reqCommunes = mysqli_query($connexion, "SELECT * FROM Communes WHERE codeInseeD = ".$nDep." ORDER BY RAND() LIMIT ". rand(5,20));
	}*/
	$communes = mysqli_fetch_all($reqCommunes, MYSQLI_ASSOC);
	return $communes;
}

// récupère des services aléatoires
function recupServiceRandom($connexion, $n)
{
	$reqCommunes = mysqli_query($connexion, "SELECT * FROM Services ORDER BY RAND() LIMIT ". $n);
	$res = mysqli_fetch_all($reqCommunes, MYSQLI_ASSOC);
	return $res;
}

// renvoie une nombre aleatoire entre 3, 4 et 6
function randomDuree()
{
	$array = array(3,4,6);
	return $array[array_rand($array, 1)];
}

?>
