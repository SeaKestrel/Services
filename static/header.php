<!-- header1 -->
<header>
	<h2 class="nompage">COMMUNAUX</h2>
	<div class="logo"><a href="index.php"></a></div>
	<div class="navbar">
		<nav>
			<ul>
				<?php 
				if(isset($_GET['page'])) {
					$nomPage = $_GET['page'];
					if(isset($routes[$nomPage])) { // si la page existe dans le tableau des routes, on la charge
						echo '<li><a href="index.php">Accueil</a></li>';
						foreach($routes as $page){
							if($page['id'] == $nomPage) {
								echo '<li><a href="index.php?page='.$page['id'].'" class="currentpage">'.$page['nom'].'</a></li>';
							} else {
								echo '<li><a href="index.php?page='.$page['id'].'">'.$page['nom'].'</a></li>';
							}
						}
					} else {
						echo '<li><a href="index.php" class="currentpage">'.$page['nom'].'</a></li>';
						foreach($routes as $page){
							echo '<li><a href="index.php?page='.$page['id'].'">'.$page['nom'].'</a></li>';
						}
					}
				} else {
					echo '<li><a href="index.php" class="currentpage">Accueil</a></li>';
					foreach($routes as $page){
						echo '<li><a href="index.php?page='.$page['id'].'">'.$page['nom'].'</a></li>';
					}
				} 
				?>
				<!-- <li><a href="index.php" class="currentpage">Accueil</a></li>
				<li><a href="index.php?page=stats">Statistiques</a></li>
				<li><a href="index.php?page=ajouter">Services</a></li>
				<li><a href="index.php?page=afficher">Liste services</a></li>
				<li><a href="index.php?page=periodeessai">Période d'essai</a></li>
				<li><a href="index.php?page=historique">Historique</a></li>-->
			</ul>
		</nav>
	</div>
	<a href="http://jean.pipantal.eu.org" class="contact">
		<svg width="53" height="53" viewBox="0 0 53 53" fill="none" xmlns="http://www.w3.org/2000/svg">
			<g filter="url(#filter0_d_12_16)">
				<path d="M34.5075 2.164C35.1842 0.529302 36.9683 -0.340777 38.6733 0.125023L46.4073 2.23431C47.9366 2.65616 49 4.04477 49 5.62673C49 27.3699 31.3699 45 9.62674 45C8.04477 45 6.65616 43.9366 6.23431 42.4073L4.12502 34.6733C3.65922 32.9683 4.5293 31.1842 6.164 30.5075L14.6011 26.992C16.0337 26.3944 17.6947 26.8074 18.6703 28.0115L22.2209 32.3443C28.4081 29.4177 33.4177 24.4081 36.3443 18.2209L32.0115 14.6791C30.8074 13.6947 30.3944 12.0425 30.992 10.6099L34.5075 2.17278V2.164Z" fill="white"/>
			</g>
			<defs>
				<filter id="filter0_d_12_16" x="0" y="0" width="53" height="53" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
				<feFlood flood-opacity="0" result="BackgroundImageFix"/>
				<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"/>
				<feOffset dy="4"/>
				<feGaussianBlur stdDeviation="2"/>
				<feComposite in2="hardAlpha" operator="out"/>
				<feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"/>
				<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_12_16"/>
				<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_12_16" result="shape"/>
				</filter>
			</defs>
		</svg>
	</a>
	<div class="shownav">
		<a>
		<svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2023 Fonticons, Inc.--><path fill="#ffffff" d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z"/></svg>
		</a>
	</div>
</header>
