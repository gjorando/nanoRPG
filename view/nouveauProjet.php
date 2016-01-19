<!DOCTYPE html>
<html lang="fr">
	<?php include_once("include/head.php"); ?>
	<body>
		<?php include_once("include/header.php"); ?>
		<div id="content_wrapper">
			<div id="content_center">
				<section class="content">
					<h2>Créer un nouveau projet</h2>
					<?php echo $err; ?>
					<form action="validerCreation.php" method="post">
							<label for="name">Nom : </label><input type="text" id="name" placeholder="Nom" name="name" /><br />
							<label for="desc">Description</label><textarea id="desc" name="desc" placeholder="Description du jeu"></textarea><br />
							<span class="checkbox_label"><input type="checkbox" name="sensible" />Ce jeu comporte un contenu sensible, potentiellement choquant et/ou à caractère érotique/sexuel.</span><br />
							
						<input type="submit" value="Créer" />
					</form>
				</section>
			</div>
		</div>
		<?php include_once("include/footer.php"); ?>
	</body>
</html>
