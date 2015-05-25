<?php
// HTTPS PLZ!
if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){ // Petit forçage de l'HTTPS
	if($_SERVER['HTTP_HOST'] != "asbf.dev") { // Si on développe en local, ne pas passer en HTTPS
		header('Location: https://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		die('Redirection en HTTPS');
	}
}

require '../includes/header.php';
require '../includes/nav.php';
require '../includes/dbConnect.php';
?>

			<!-- Contenu -->
			<div class="col-lg-9">
				<div class="bs-component">

					<?php
					// Cette page est juste pour demander confirmation pour la suppression

					if(!empty($_GET['id'])) {
						$id = $_GET['id'];
						$reponse = $bdd->query("SELECT `titre` FROM news WHERE `id` = '$id'");
						$donnees = $reponse->fetch();
						echo '<div class="alert alert-warning">
						<p>Êtes-vous certain de supprimer "'. $donnees['titre'] .'" ?</p>
						<form method="post" action="index.php" style="text-align: center">
							<input type="hidden" style="display: none;" name="id" value="'. $id .'"/>
							<input type="hidden" style="display: none;" name="del" value="1"/>
							<br>
							<p>
								<button type="submit" name="submit" class="btn btn-primary">Oui</button>
								<a href="index.php"><span class="btn btn-default">Non</span></a>
							</p>
						</form>
					</div>';
					} else {
                    	echo '<div class="alert alert-error"><p>Aucune informations sur quel article à supprimer, retourner en arrière et ré-essayez</p></div>';
                    }
					?>

				</div> <!-- //.bs-component -->
			</div> <!-- //.col-lg-9 -->

<?php require '../includes/footer.php'; ?>
