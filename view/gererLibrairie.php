<!DOCTYPE html>
<html lang="fr">
	<?php include_once("include/head.php"); ?>
	<body>
		<?php include_once("include/header.php"); ?>
		<div id="content_wrapper">
			<div id="content_center">
				<section class="content">
					<?php if(isset($_GET['confirm']) || !$gameInLibrary || isset($_GET['ghostDelete']))
					{ ?>
					<h2><?php echo $jeu['name']; ?> a bien été <?php echo $action; ?> votre librairie.</h2>
					<?php }
					else
					{ ?>
					<h2>Êtes-vous certain-e de vouloir supprimer <?php echo $jeu['name']; ?> de votre librairie ?</h2>
					<p>Toutes les données de sauvegarde associées seront supprimées. Il n'y a aucune possibilité de retour en arrière.</p>
					<p><a href="gererLibrairie.php?id=<?php echo $_GET['id']; ?>&confirm" title="Cette action est irréversible">Supprimer le jeu de la librairie</a></p>
					<?php } ?>
					<p><a href="/" title="Accueil">Retour à l'accueil</a></p>
				</section>
			</div>
		</div>
		<?php include_once("include/footer.php"); ?>
	</body>
</html>
