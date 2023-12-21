<h2>Statistiques du système</h2>

<div class="stats">
	<div class="card">
		<h3>Statistiques locales</h3>
		<ul>
			<?php foreach(array_keys($stats) as $stat) { ?>
				<li><?= $stats[$stat] ?> <?= $stat ?> dans la base de données</li>
			<?php } ?>
		</ul>
	</div>
	<div class="card">
		<h3>Liste des enfants et de leur école :</h3>
		<?php if(isset($mErrInscription)) { ?>
			<p class="erreur"><?= $mErrInscription ?></p>
		<?php } else { ?>
		<table class="table-inscription">
			<tr class="nom-champs">
				<td>Nom</td>
				<td>Prénom</td>
				<td>École</td>
			</tr>
			<?php foreach($inscriptions as $inscription) { ?>
			<tr>
			
				<td><?= $inscription['nomE'] ?></td>
				<td><?= $inscription['prénomE'] ?></td>
				<td><?= $inscription['nomL'] ?></td>
			</tr>
			<?php } ?>
		</table>
		<?php } ?>
	</div>
	<div class="card">
		<h3>Élèves mangeant à la cantine le 01/01/2024 :</h3>
		<?php if(isset($mErrCant)) { ?>
			<p class="erreur"><?= $mErrCant ?></p>
		<?php } else { ?>
		<table class="table-inscription">
			<tr class="nom-champs">
				<td>Nom</td>
				<td>Prénom</td>
				<td>Cantine</td>
			</tr>
			<?php foreach($cantines as $cant) { ?>
			<tr>
			
				<td><?= $cant['nomE'] ?></td>
				<td><?= $cant['prénomE'] ?></td>
				<td><?= $cant['nomCant'] ?></td>
			</tr>
			<?php } ?>
		</table>
		<?php } ?>
	</div>
	<div class="card">
		<h3>Élèves ayant le même nom mais inscrit dans des écoles différentes :</h3>
		<?php if(isset($mErrMmInscriptions)) { ?>
			<p class="erreur"><?= $mErrMmInscriptions ?></p>
		<?php } else { ?>
		<ul>
			<?php foreach($inscriptionscommunes as $i) { 
				if ($i['nb'] > 1) { ?>
				<li><?= $i['nb'] ?> <?= $i['nomE'] ?> <?= $i['prénomE'] ?> inscrits dans <?= $i['nb'] ?> écoles différentes</li>
			<?php } 
			} ?>
		</ul>
		<?php } ?>
	</div>
	<div class="card">
		<h3>Top département ayant le plus de communes :</h3>
		<?php if(isset($mErrTopDep)) { ?>
			<p class="erreur"><?= $mErrTopDep ?></p>
		<?php } else { ?>
		<ol>
			<?php foreach($topdepartement as $dep) { ?>
			<li><?= $dep['nomD'] ?> avec <?= $dep['nbCommunes'] ?> communes</li>
			<?php } ?>
		</ol>
		<?php } ?>
	</div>
	<div class="card">
		<h3>Top services les plus demandés par les citoyens :</h3>
		<?php if(isset($mErrDem)) { ?>
			<p class="erreur"><?= $mErrDem ?></p>
		<?php } else { ?>
		<ol class="top">
			<?php foreach($topdem as $dem) { ?>
			<li><?= $dem["libellé"] ?> avec <?= $dem["nb"] ?> demandes</li>
			<?php } ?>
		</table>
		<?php } ?>
	</div>
	<div class="card">
		<h3>Top services les plus proposés par les communes :</h3>
		<?php if(isset($mErrSer)) { ?>
			<p class="erreur"><?= $mErrSer ?></p>
		<?php } else { ?>
		<ol class="top">
			<?php foreach($topservices as $ser) { ?>
			<li><?= $ser["libellé"] ?> utilisé dans <?= $ser["nb"] ?> communes</li>
			<?php } ?>
		</table>
		<?php } ?>
	</div>
	<div class="card">
		<h3>Top communes qui réalisent le plus d'unions :</h3>
		<?php if(isset($mErrTopUnions)) { ?>
			<p class="erreur"><?= $mErrTopUnions ?></p>
		<?php } else { ?>
		<ol class="top">
			<?php foreach($topunions as $union) { ?>
			<li><?= $union["nomCom"] ?> avec <?= $union["nb"] ?> unions</li>
			<?php } ?>
		</table>
		<?php } ?>
	</div>
</div>




