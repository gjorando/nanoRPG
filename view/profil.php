<!DOCTYPE html>
<html lang="fr">
	<?php include_once("include/head.php"); ?>
	<body>
		<?php include_once("include/header.php"); ?>
		<div id="content_wrapper">
			<div id="content_left">
				<section class="content">
					<div id="avatar_profil"><img width="128px" src="<?php echo $avatar; ?>" alt="avatar de <?php echo $data['nom']; ?>" /></div>
					<h2><?php echo $data['nom']; ?></h2>
					<dl id="desc_profil">
						<dt>Pseudo</dt><dd><?php echo $data['pseudo'];  ?></dd>
						<dt>Email</dt><dd><?php echo $data['email']; ?></dd>
						<dt>Date de naissance</dt><dd><?php echo $data['date_naissance']; ?></dd>
						<dt>Genre</dt><dd><?php echo $data['gender']; ?></dd>
						<dt>Biographie</dt><dd><?php echo $data['bio']; ?></dd>
					</dl>
					<?php echo $editLink; ?>
				</section>
			</div>
			<div id="content_right">
				<section class="content">
					<h2>Exemple2</h2>
				</section>
			</div>
		</div>
		<?php include_once("include/footer.php"); ?>
	</body>
</html>
