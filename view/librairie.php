<!DOCTYPE html>
<html lang="fr">
	<?php include_once("include/head.php"); ?>
	<body>
		<?php include_once("include/header.php"); ?>
		<div id="content_wrapper">
			<div id="content_center content_large">
				<section class="content">
					<h2>Librairie de <?php displayPseudo($utilisateur['name'], $utilisateur['admin']); ?></h2>
					<?php displayGameList($jeux, true, true); ?>
					<?php displayPager('librairie.php?id=' . $uid, $qtePages, $page, true); ?>
				</section>
			</div>
		</div>
		<?php include_once("include/footer.php"); ?>
	</body>
</html>
