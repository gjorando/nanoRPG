<!DOCTYPE html>
<html lang="fr">
	<?php include_once("include/head.php"); ?>
	<body>
		<?php include_once("include/header.php"); ?>
		<div id="content_wrapper">
			<div id="content_center content_large">
				<section class="content">
					<h2>Le projet</h2>
					<p>ηRPG est un projet de DUT Info AS de l'IUT d'Amiens. Il est né de l'idée de mettre au point un système de partage de jeux d'aventure textuels designés par les utilisateurs-ices.</p>
					<h2>Les porteurs du projet</h2>
					<dl id="porteurs">
						<?php foreach($porteurs as $p)
						{?>
						<dt><a href="profil.php?id=<?php echo $p['id']; ?>"><img src="<?php echo getAvatarPath($p['id'], $p['avatar']); ?>" alt="<?php echo $p['pseudo'];?>" width="64" /><?php echo $p['name']; ?></a></dt><dd><?php echo $p['bio'];?></dd>
						<?php } ?>
					</dl>
				</section>
			</div>
		</div>
		<?php include_once("include/footer.php"); ?>
	</body>
</html>
