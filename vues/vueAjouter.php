<h2>Ajoutez un service à votre commune</h2>

<div class="form">
	<form class="formajouter" method="post" action="#">
		<!-- Liste des communes -->
		<label for="commune">Commune : </label><br/>
		<select name="commune" id="commune" required>
		<?php foreach($communes as $commune) { ?>
			<option value="<?= $commune["idC"] ?>"><?= $commune["nomCom"] ?></option>
		<?php } ?>
		</select><br/>
		<!-- Nom du service -->
		<label for="libellé">Service : </label><br/>
		<select name="libellé" id="libellé" required>
		<?php foreach($services as $service) { ?>
			<option value="<?= $service["libellé"] ?>"> <?= $service["libellé"] ?> - <?= ($service["payant_"]==1?"Payant":"Gratuit") ?></option>
		<?php } ?>
		</select>
		<!-- Date -->
		<label for="datedeb">Date de début de disponibilité</label><br/>
		<input type="date" name="datedeb" id="deb" required/><br/>
		<label for="datefin">Date de fin de disponibilité</label><br/>
		<input type="date" name="datefin" id="fin" required/>
		<br/><br/>
		<!-- Envoi du formulaire -->
		<input type="submit" name="boutonValider" value="Ajouter"/>
	</form>
</div>
