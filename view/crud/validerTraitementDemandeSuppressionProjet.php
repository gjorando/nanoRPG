<!DOCTYPE html>
<html lang="fr">
	<?php include_once("../view/include/head.php"); ?>
	<body>
		<?php include_once("include/header.php"); ?>
		<div id="content_wrapper">
			<div id="content_center">
				<section class="content">
					<h2>Demande de suppression traitée !</h2>
					<p>La demande de suppression de <?php echo $req['name']; ?> a bien été traitée !<br />
					Résumé de la décision : <?= $_POST['decision'] ?><br />
					<?= $actionMessage ?>
					
					<?php if(!$selfDecision)
					{ ?>
					<br /><a href="/profil.php?id=<?= $req['id_requester']?>"><?php displayPseudo($req['pseudo'], $req['admin']); ?></a> a été informé par message chat de la décision.
					<?php } ?>
					</p>
					<p><a href="./demandesSuppressionJeu.php">Retour aux requêtes de suppression</a></p>
				</section>
			</div>
		</div>
		<?php include_once("../view/include/footer.php"); ?>
	</body>
</html>
