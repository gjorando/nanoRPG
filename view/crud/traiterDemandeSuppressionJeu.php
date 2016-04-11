<!DOCTYPE html>
<html lang="fr">
	<?php include_once("../view/include/head.php"); ?>
	<body>
		<?php include_once("include/header.php"); ?>
		<div id="content_wrapper">
			<div id="content_center">
				<section class="content">
					<h2>Examen de la demande de suppression de <a href="/pageDeJeu.php?id=<?= $req['id_game'] ?>"><?= $req['name'] ?></a></h2>
					<?php echo $err; ?>
					<p>Postée par <a href="/profil.php?id=<?= $req['id_requester']?>"><?php displayPseudo($req['pseudo'], $req['admin']); ?></a> le <?= $req['request_date'] ?><br />
					Raison : <?= $req['reason'] ?></p>
					<ul>
						<li>Nombre de joueurs : <?= $playersCount ?></li>
						<li>TODO : Ajouter le nombre de maps du jeu, et autres statistiques (quand ceci sera prêt)</li>
					</ul>

					<form action="validerTraitementDemandeSuppressionProjet.php?id=<?= $_GET['id'] ?>" method="post">
						<label for="decision">Décision : </label><textarea id="decision" name="decision" placeholder="Décrivez les raisons qui vous motivent à prendre cette décision"></textarea><br />
						<p class="pForm">Action : </p>
						<input type="radio" name="action" value="delete-action" id="delete-action" /><label class="radio_label" for="delete-action"><span class="avertInfo icon">Supprimer le jeu</span></label><br />
						<input type="radio" name="action" value="migrate-action" id="migrate-action" /><label class="radio_label" for="migrate-action">Modifier son propriétaire</label><input type="number" id="input-new-id" name="id-new" min="1" placeholder="id du nouveau propriétaire"/><br />
						<input type="radio" name="action" value="nothing-action" id="nothing-action" checked /><label class="radio_label" for="nothing-action">Ne rien faire</label><br />
						<input type="submit" value="Valider" />
					</form>
				</section>
			</div>
		</div>
		<?php include_once("../view/include/footer.php"); ?>
	</body>
</html>
