<!DOCTYPE html>
<html lang="fr">
	<?php include_once("include/head.php"); ?>
	<body>
		<?php include_once("include/header.php"); ?>
		<div id="content_wrapper">
			<div id="content_center">
				<section class="content">
					<h2>Connexion</h2>
					<?php echo $err; ?>
					<form action="validerConnexion.php" method="post">
						<label for="pseudo">Pseudo : </label><input type="text" id="pseudo" placeholder="Pseudo" name="pseudo" /><br />
						<label for="mdp">Mot de passe : </label><input type="password" id="mdp" placeholder="Mot de passe" name="mdp" /><br />
						<input type="submit" value="Connexion" />
					</form>
					<p><a href="inscription.php" title="Inscription">Pas encore inscrit ?</a></p>
				</section>
			</div>
		</div>
		<?php include_once("include/footer.php"); ?>
	</body>
</html>
