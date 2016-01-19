<!DOCTYPE html>
<html lang="fr">
	<?php include_once("include/head.php"); ?>
	<body>
		<?php include_once("include/header.php"); ?>
		<div id="content_wrapper">
			<div id="content_center">
				<section class="content">
					<h2>Création validée !</h2>
					<p>Le jeu <?php echo $_POST['name']; ?> a bien été créé !<br />
					Vous pouvez maintenant passer en mode création.</p>
					<p><a href="profil.php" title="Profil">Retour au profil</a></p>
				</section>
			</div>
		</div>
		<?php include_once("include/footer.php"); ?>
	</body>
</html>
