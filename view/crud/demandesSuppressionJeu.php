<!DOCTYPE html>
<html lang="fr">
	<?php include_once("../view/include/head.php");?>
	<body>
		<?php include_once("include/header.php"); ?>
		<div id="content_wrapper">
			<div id="content_left">
				<section class="content">
					<h2>Demandes en attente</h2>
					<?php displayDeletionRequests($awaiting); ?>
				</section>
			</div>
			<div id="content_right">
				<section class="content">
					<h2>Demandes traitées</h2>
				</section>
			</div>
		</div>
		<?php include_once("../view/include/footer.php"); ?>
	</body>
</html>
