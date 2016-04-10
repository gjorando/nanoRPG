<!DOCTYPE html>
<html lang="fr">
	<?php include_once("include/head.php"); ?>
	<body>
		<?php include_once("include/header.php"); ?>
		<div id="content_wrapper">
			<div id="content_center">
				<section class="content">
					<h2>Demander la suppression de <?= $game['name'] ?></h2>
					<?php echo $err; ?>
					<?php if($adminMode && !$ownGame)
					{ ?>
						<span class="avertInfo icon">Ce jeu ne vous appartient pas, mais en tant qu'administrateur vous pouvez quand même demander sa suppression. Gardez quand même à l'esprit qu'un grand pouvoir implique de grandes responsabilités.</span>
					<?php } ?>
					<p>Alors comme ça, vous désirez supprimer <?= $game['name'] ?> ? :( Soit, nous ne vous jugeons pas. Cependant, pensez au fait que plusieurs personnes y jouent peut-être, et que sa disparition pourrait leur causer du tort ! Merci de justifier la raison de cette demande, nous l'examinerons et déciderons de sa suppression, ou de son changement de propriétaire. Réfléchissez judicieusement auparavant, une demande en cours ne peut être annulée, et l'administrateur qui l'examinera est seul décideur de l'action finale à entreprendre !</p>
					<form action="validerDemandeSuppressionProjet.php?id=<?= $_GET['id'] ?>" method="post">
							<label for="reason">Raison</label><textarea id="reason" name="reason" placeholder="Donnez une description claire et complète des raisons qui vous motivent à demander la suppression de <?= $game['name'] ?>"></textarea><br />
							
						<input type="submit" value="Créer" />
					</form>
				</section>
			</div>
		</div>
		<?php include_once("include/footer.php"); ?>
	</body>
</html>
