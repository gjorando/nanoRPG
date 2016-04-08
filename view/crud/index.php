<!DOCTYPE html>
<html lang="fr">
	<?php include_once("../view/include/head.php");?>
	<body>
		<?php include_once("include/header.php"); ?>
		<div id="content_wrapper">
			<div id="content_large">
				<section class="content">
					<h2>Présentation</h2>
					<p>(En construction...)</p>
					<ul>
						<li><a href="demandesSuppressionJeu.php">Demandes de suppression de jeu <?php echo($awaitingCount?'(' . $awaitingCount . ')':''); ?></a></li>
					</ul>
				</section>
			</div>
		</div>
		<?php include_once("../view/include/footer.php"); ?>
	</body>
</html>
