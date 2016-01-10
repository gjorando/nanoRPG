<!DOCTYPE html>
<html lang="fr">
	<?php include_once("include/head.php"); ?>
	<body>
		<?php include_once("include/header.php"); ?>
		<div id="content_wrapper">
			<div id="content_center">
				<section class="content">
					<h2>Edition du profil</h2>
					<?php echo $err; ?>
					<form action="validerEdition.php" method="post">
						<fieldset>
							<legend>Informations de connexion</legend>
							<label for="mdp">Nouveau mot de passe : </label><input type="password" id="mdp" placeholder="Mot de passe" name="mdp" /><br />
							<label for="mdp_confirm">Confirmez : </label><input type="password" id="mdp_confirm" placeholder="Mot de passe" name="mdp_confirm" /><br />
						</fieldset>
						<fieldset>
							<legend>Informations personnelles</legend>
							<label for="email">E-mail : <label><input type="text" id="email" placeholder="exemple@exemple.ex" name="email" value="<?php echo $data['email']; ?>" /><br />
							<label for="nom">Nom complet : </label><input type="text" id="nom" placeholder="Nom complet" name="nom" value="<?php echo $data['nom']; ?>" /><br />
							<label for="genre">Genre : </label>
							<select id="genre" name="genre">
								<option value="Homme" <?php echo($genderValue == 1?"selected":""); ?>>Homme</option>
								<option value="Femme" <?php echo($genderValue == 2?"selected":""); ?>>Femme</option>
								<option value="Autre" <?php echo($genderValue == 0?"selected":""); ?>>Autre</option>
							</select><br />
							<label for="bio">Biographie</label><textarea id="bio" name="bio" placeholder="Description plus ou moins longue de l'utilisateur"><?php echo $data['bio']; ?></textarea>
						</fieldset>
						<input type="submit" value="Valider" />
					</form>
				</section>
			</div>
		</div>
		<?php include_once("include/footer.php"); ?>
	</body>
</html>
