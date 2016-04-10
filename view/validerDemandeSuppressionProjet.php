<!DOCTYPE html>
<html lang="fr">
	<?php include_once("include/head.php"); ?>
	<body>
		<?php include_once("include/header.php"); ?>
		<div id="content_wrapper">
			<div id="content_center">
				<section class="content">
					<h2>Demande de suppression validée !</h2>
					<p>La demande de suppression de <?php echo $game['name']; ?> a bien été créé !<br />
					Merci de patienter le temps qu'un administrateur traite la demande.</p>
					<p><a href="pageDeJeu.php?id=<?= $_GET['id'] ?>" title="<?= $game['name'] ?>">Retour à la page de jeu</a></p>
				</section>
			</div>
		</div>
		<?php include_once("include/footer.php"); ?>
	</body>
</html>
