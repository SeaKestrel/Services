<h2>Période d'essais</h2>

<div class="form">
	<h4>Générez une période d'essai pour votre commune</h4>
	<form class="formajouter" method="post" action="#">
		<!-- Liste des communes -->
		<label for="departement">Département : </label><br/>
		<select name="departement" id="departement">
			<option value="none">Aucun</option>
			<?php foreach($departements as $departement) { ?>
				<option value="<?= $departement["codeInseeD"] ?>"> <?= $departement["nomD"] ?></option>
			<?php } ?>
		</select><br/>
		<label for="dureemax">Durée maximale : </label><br/>
		<input type="text" name="dureemax" id="dureemax" placeholder="mois"/><br/>
		
		<label for="kilometre">Rayon de la période d'essai: </label><br/>
		<input type="text" name="kilometre" id="kilometre" placeholder="km"/><br/>
		<br/><br/>
		<!-- Envoi du formulaire -->
		<input class="demandeperiodeessai" type="submit" name="boutonValider" value="Demander une période d'essai"/>
	</form>
</div>

<div class="generation">
	<h3></h3>
</div>
