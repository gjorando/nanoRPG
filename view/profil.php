<!DOCTYPE html>
<html lang="fr">
	<?php include_once("include/head.php"); ?>
	<body>
		<?php include_once("include/header.php"); ?>
		<div id="content_wrapper">
			<div id="content_left">
				<section class="content">
					<div id="avatar_profil"><img width="128px" src="<?php echo $avatar; ?>" alt="avatar de <?php echo $data['name']; ?>" /></div>
					<h2><?php displayPseudo($data['name'], $data['admin']); ?></h2>
					<dl id="desc_profil">
						<dt>Pseudo</dt><dd><?php echo $data['pseudo'];  ?></dd>
						<dt>Email</dt><dd><?php echo $data['email']; ?></dd>
						<dt>Date de naissance</dt><dd><?php echo $data['birth']; ?></dd>
						<dt>Genre</dt><dd><?php echo $data['gender']; ?></dd>
						<dt>Biographie</dt><dd><?php echo $data['bio']; ?></dd>
					</dl>
					<?php echo $editLink; ?>
				</section>
			</div>
			<div id="content_right">
				<section class="content">
					<h2>Récemment joués</h2>
					<?php displayGameList($libs, false, true); ?>
					<a class="lien_tous" href="librairie.php?id=<?php echo $uid;?>">Librairie complète</a>
				</section>
				<section class="content">
					<h2>Liste des créations</h2>
					<?php displayGameList($jeux); ?>
					<a class="lien_tous" href="creations.php?id=<?php echo $uid;?>">Toutes les créations</a>
				</section>
			</div>
		</div>
		<?php include_once("include/footer.php"); ?>
	</body>
</html>
