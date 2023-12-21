<h2>Affichage des services</h2>

<?php if(isset($message)) { ?>
	<p class="Erreur"><?= $message ?></p>
<?php } else {
	foreach($services as $service) { ?>
	<div class="service card">
		<div class="nomservice">
			<h4><?= $service["libellé"] ?></h4>
			<p class="acces"><?= ($service["payant_"]==1?"Payant":"Gratuit") ?></p>
		</div>
		<p class="desc"><?= $service["descS"]?></p>
	</div>
<?php
	}
	}	
?>


			