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
						<dt>Créateur</dt><dd><a href="profil.php?id=<?php echo $jeu['id_creator']; ?>"><img width="32" src="<?php echo $avatar; ?>" alt="avatar de <?php echo $jeu['pseudo']; ?>" /><?php displayPseudo($jeu['pseudo'], $jeu['admin']); ?></a></dd>
						<dt>Dernière modification</dt><dd><?php echo strtoupper(substr($jeu['last_modified'], 0, 1)) . substr($jeu['last_modified'], 1); ?></dd>
						<dt>Description</dt><dd><?php echo $jeu['description']; ?></dd>
						<?php if($editable or $playable)
						{ ?>
						<dt>Actions</dt>
						<dd>
						<ul>
							<?php if($editable)
							{ ?>

							<?php if(!$ownGame)
							{ ?>
							<span class="avertInfo icon">Ce jeu ne vous appartient pas, mais en tant qu'administrateur vous pouvez quand même accéder aux paramètres de modification, de création ou de suppression. Gardez quand même à l'esprit qu'un grand pouvoir implique de grandes responsabilités.</span>
							<?php } ?>

							<li><a href="modifierProjet.php?id=<?php echo $jeu['id']; ?>">Modifier les paramètres du projet</a></li>
							<li><a href="null.php?id=<?php echo $jeu['id']; ?>">Mode création</a></li>
							<li><?php if(!deletionAlreadyRequested($jeu['id']))
							{ ?>
								<a href="demanderSuppressionProjet.php?id=<?php echo $jeu['id']; ?>">Supprimer le projet</a>
							<?php }
							else
							{ ?>
								<span class="errInfo icon">Il y a déjà une demande de suppression, merci d'attendre que celle-ci soit traitée avant d'en effectuer une autre !</span>
							<?php } ?>
							</li>
						<?php
							}
							if($playable)
							{ ?>
							<li><a href="gererLibrairie.php?id=<?php echo $jeu['id'];?>"><?php echo ($deleteGame?'Supprimer de':'Ajouter à'); ?> la librairie</a></li>
							<li><a href="">Signaler le jeu TODO</a></li>
						<?php
							} ?>
						</ul></dd>
						<?php } ?>
					</dl>
				</section>
			</div>
		</div>
		<?php include_once("include/footer.php"); ?>
	</body>
</html>
