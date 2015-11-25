<header>
	<h1>ηRPG</h1>
</header>
<nav>
	<a href="/">Accueil</a>
	<?php 
	if(isLogged())
	{
	?>
		<a href="#">Profil</a>
		<a href="/disconnect.php">Déconnexion</a>
	<?php
	}
	else
	{
	?>
		<a href="/connexion.php">Connexion</a>
	<?php
	}
	?>
	<a href="#">A propos</a>
</nav>

