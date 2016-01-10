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
						<dt>Biographie</dt><dd><?php echo nl2br($data['bio']); ?></dd>
					</dl>
					<?php echo $editLink; ?>
				</section>
			</div>
			<div id="content_right">
				<section class="content"> <!--TODO Remplissage temporaire -->
					<h2>Récemment joués</h2>
					<dl class="games_list">
						<dt>Rogue reborn</dt><dd>5 heures de jeu | <a href="#">Page du jeu</a></dd>
						<dt>Yada Yamete Kodasai</dt><dd>45 heures de jeu | <a href="#">Page du jeu</a></dd>
					</dl>
				</section>
				<section class="content">
					<h2>Liste des créations</h2>
					<dl class="games_list">
						<dt>Yada Yamete Kodasai</dt><dd>Dernière édition : 03/01/2016 | <a href="#">Page du jeu</a></dd>
						<dt>The Elder Scrolls V: Skyrim</dt><dd>Dernière édition : 31/12/2015 | <a href="#">Page du jeu</a></dd>
						<dt>Cookie adventures</dt><dd>Dernière édition : 1/04/2010 | <a href="#">Page du jeu</a></dd>
						<dt>White dragon awakening</dt><dd>Dernière édition : 06/09/2012 | <a href="#">Page du jeu</a></dd>
						<dt>mon premié jeu vidéos</dt><dd>Dernière édition : 03/10/2004 | <a href="#">Page du jeu</a></dd>
					</dl>
				</section>
			</div>
		</div>
		<?php include_once("include/footer.php"); ?>
	</body>
</html>
