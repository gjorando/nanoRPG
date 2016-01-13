<!DOCTYPE html>
<html lang="fr">
	<?php include_once("include/head.php"); ?>
	<body>
		<?php include_once("include/header.php"); ?>
		<div id="content_wrapper">
			<div id="content_center">
				<section class="content">
					<h2>Inscription validée !</h2>
					<p>Bienvenue sur nanoRPG, <?php echo $_POST['name']; ?> !<br />
					Vous pouvez maintenant vous connecter via <a href="connexion.php" title="Connexion">ce lien</a>.</p>
					<p><a href="/" title="Accueil">Retour à l'accueil</a></p>
				</section>
			</div>
		</div>
		<?php include_once("include/footer.php"); ?>
	</body>
</html>
