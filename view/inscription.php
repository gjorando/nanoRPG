<!DOCTYPE html>
<html lang="fr">
	<?php include_once("include/head.php"); ?>
	<body>
		<?php include_once("include/header.php"); ?>
		<div id="content_wrapper">
			<div id="content_center">
				<section class="content">
					<h2>Inscription</h2>
					<?php if(isset($_GET['err']))
					{ ?>
					<div id="err">
						<?php
							switch($_GET['err'])
							{
								case 1:
									echo "Merci de compléter tous les champs du formulaire !";
									break;
								case 2:
									echo "Les mots de passe ne correspondent pas !";
									break;
								case 3:
									echo "L'email entré est incorrect !";
									break;
								case 4:
									echo "Le mot de passe doit comporter au moins dix caractères !";
									break;
								case 5:	
									echo "Le pseudo ne peut excéder 20 caractères !";
									break;
								case 6:
									echo "Le nom complet ne peut excéder 40 caractères !";
									break;
								case 7:
									echo "La date doit respecter le format DD/MM/YYYY !";
									break;
								default:
									echo "Cessez donc de modifier l'URL, petit malandrin !";
							}
						?>
					</div>
					<?php } ?>
					<form action="validerInscription.php" method="post">
						<fieldset>
							<legend>Informations de connexion</legend>
							<label for="pseudo">Pseudo : </label><input type="text" id="pseudo" placeholder="Pseudo" name="pseudo" /><br />
							<label for="mdp">Mot de passe : </label><input type="password" id="mdp" placeholder="Mot de passe" name="mdp" /><br />
							<label for="mdp_confirm">Confirmez : </label><input type="password" id="mdp_confirm" placeholder="Mot de passe" name="mdpConfirm" /><br />
						</fieldset>
						<fieldset>
							<legend>Informations personnelles</legend>
							<label for="email">E-mail : <label><input type="text" id="email" placeholder="exemple@exemple.ex" name="email" /><br />
							<label for="nom">Nom complet : </label><input type="text" id="nom" placeholder="Nom complet" name="nom" /><br />
							<label for="date_naissance">Date de naissance : </label><input type="date" id="date_naissance" placeholder="JJ/MM/AAAA" name="dateNaissance" /><br />
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
