<!DOCTYPE html>
<html lang="fr">
	<?php include_once("include/head.php"); ?>
	<body>
		<?php include_once("include/header.php"); ?>
		<div id="content_wrapper">
			<div id="content_center content_large">
				<section class="content">
					<h2><?php echo $page_title . ($jeu['sensible']?' <span title="Contenu sensible" class="jeu_sensible">/!\</span> ':''); ?></h2>
					<dl id="desc_game">
						<dt>Créateur</dt><dd><a href="profil.php?id=<?php echo $jeu['id_creator']; ?>"><img width="32px" src="<?php echo $avatar; ?>" alt="avatar de <?php echo $jeu['pseudo']; ?>" /><?php displayPseudo($jeu['pseudo'], $jeu['admin']); ?></a></dd>
						<dt>Dernière modification</dt><dd><?php echo strtoupper(substr($jeu['last_modified'], 0, 1)) . substr($jeu['last_modified'], 1); ?></dd>
						<dt>Description</dt><dd><?php echo $jeu['description']; ?></dd>
					</dl>
				</section>
			</div>
		</div>
		<?php include_once("include/footer.php"); ?>
	</body>
</html>
