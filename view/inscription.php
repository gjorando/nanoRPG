<!DOCTYPE html>
<html lang="fr">
	<?php include_once("include/head.php"); ?>
	<body>
		<?php include_once("include/header.php"); ?>
		<div id="content_wrapper">
			<div id="content_center">
				<section class="content">
					<h2>Inscription</h2>
					<?php echo $err; ?>
					<form action="validerInscription.php" method="post">
						<fieldset>
							<legend>Informations de connexion</legend>
							<label for="pseudo">Pseudo : </label><input type="text" id="pseudo" placeholder="Pseudo" name="pseudo" /><br />
							<label for="mdp">Mot de passe : </label><input type="password" id="mdp" placeholder="Mot de passe" name="mdp" /><br />
							<label for="mdp_confirm">Confirmez : </label><input type="password" id="mdp_confirm" placeholder="Mot de passe" name="mdp_confirm" /><br />
						</fieldset>
						<fieldset>
							<legend>Informations personnelles</legend>
							<label for="email">E-mail : <label><input type="text" id="email" placeholder="exemple@exemple.ex" name="email" /><br />
							<label for="nom">Nom complet : </label><input type="text" id="nom" placeholder="Nom complet" name="name" /><br />
							<label for="date_naissance">Date de naissance : </label><input type="date" id="date_naissance" placeholder="JJ/MM/AAAA" name="birth" /><br />
							<label for="genre">Genre : </label>
							<select id="genre" name="genre">
								<option value="Homme">Homme</option>
								<option value="Femme">Femme</option>
								<option value="Autre">Autre</option>
							</select>
						</fieldset>
						<span class="checkbox_label"><input type="checkbox" name="tos" />J'accepte les <a href="TOS" target="_blank" title="CGU">conditions générales d'utilisation de nanoRPG</a> sans réserve.</span><br />
						<input type="submit" value="Valider" />
					</form>
				</section>
			</div>
		</div>
		<?php include_once("include/footer.php"); ?>
	</body>
</html>
