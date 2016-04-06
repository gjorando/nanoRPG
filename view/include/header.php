<div id="header-wrapper">
	<nav>
	<header>
		<h1><a id="logo_title" href="/"><img src="/img/logo.png" height="150" alt="logo" /> ηRPG</a></h1>
	</header>
		<ul>
		<li><a href="/">Accueil</a></li>
		<li><?php 
		if(isLogged())
		{
		?>
			<a href="/profil.php">Profil</a></li>
			<li><a href="/disconnect.php">Déconnexion</a>
		<?php
		}
		else
		{
		?>
			<a href="/connexion.php">Connexion</a>
		<?php
		}
		?></li>
		<li><a href="/membres.php">Membres</a></li>
		<li><a href="/aPropos.php">A propos</a></li>
		<?php
		if(isAdmin(getUserId()))
		{ 
		?>
		<li><a href="/crud">CRUD</a></li>
		<?php
		}
		?>
		</ul>
	</nav>
</div>
