<!DOCTYPE html>
<html lang="fr">
	<?php include_once("include/head.php"); ?>
	<body>
		<?php include_once("include/header.php"); ?>
		<div id="content_wrapper">
			<div id="content_center">
				<section class="content">
					<h2>Chat avec <?php echo $pseudo; ?></h2>
					<div id="chat">
						<?php if(!empty($messages))
						{ ?>
						<dl>
							<?php foreach($messages as &$msg)
							{ ?>
							<dt><a href="profil.php?id=<?= $msg['id_sender'] ?>"><img src="<?php echo getAvatarPath($msg['id_sender'], $msg['avatar']); ?>" width="32" /><?php displayPseudo($msg['pseudo'], $msg['admin']); ?></a><span class="date_envoi"><?php echo $msg['send_date']; ?></span></dt><dd><?php echo $msg['msg_body']; ?></dd>
							<?php } ?>
						</dl>
						<?php } ?>
						<span id="bottom"></span>
					</div>
					<form action="posterMessage.php?id=<?php echo $_GET['id']; ?>" method="post">
						<input id="msg_box" type="text" placeholder="Message" name="msg" />
						<input type="submit" value="Envoyer" />
					</form>
					<a href="profil.php?id=<?php echo $_GET['id']; ?>" title="Profil de <?php echo $pseudo; ?>">Retour au profil</a>
				</section>
			</div>
		</div>
		<?php include_once("include/footer.php"); ?>
	</body>
</html>
