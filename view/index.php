<!DOCTYPE html>
<html lang="fr">
	<?php include_once("include/head.php"); ?>
	<body>
		<?php include_once("include/header.php"); ?>
		<div id="content_wrapper">
			<div id="content_left">
				<section class="content">
					<h2>Présentation</h2>
					<p>ηRPG est un système de création et de partage de jeux de rôle minimalistes en mode texte. Le système de jeu est très simple et est un héritage direct de comme Rogue ou Colossal Cave Adventure. ηRPG a de particulier qu'il propose à chacun-e de construire et jouer à son propre jeu, à l'aide d'une interface dédiée.</p>
					<p>Mettez à l'épreuve votre imagination et votre ingéniosité avec ηRPG ! Inscrivez vous gratuitement et commencez tout de suite une nouvelle création !</p>
				</section>
			</div>
			<div id="content_right">
				<section class="content center">
					<a class="BRB" href="<?php echo $brb_target; ?>"><span><?php echo $brb_title; ?></span></a>
					<?php echo $brb_sub; ?>
				</section>
			</div>
		</div>
		<?php include_once("include/footer.php"); ?>
	</body>
</html>
