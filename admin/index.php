<?php
// HTTPS PLZ!
if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){ // Petit forçage de l'HTTPS
	if($_SERVER['HTTP_HOST'] != "asbf.dev") { // Si on développe en local, ne pas passer en HTTPS
		header('Location: https://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		die('Redirection en HTTPS');
	}
}

// Fonction pour créer le slug - http://code.seebz.net/p/to-permalink/
function slug($str){
	if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') )
		$str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
	$str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
	$str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\\1', $str);
	$str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
	$str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $str);
	$str = strtolower( trim($str, '-') );
	return $str;
}

require '../includes/header.php';
require '../includes/nav.php';
require '../includes/dbConnect.php';
?>

			<!-- Contenu -->
			<div class="col-lg-9">
				<div class="bs-component">

					<?php

					// Beaucoup de choses ici ! -- S'il y a un POST, on le traite...
					if(!empty($_POST)) {
						$date = date("Y-m-d H:i:s");

						if(!empty($_POST['del'])) { // Suppression, après avoir passé par la validation sur delete.php
							try {
								$req = $bdd->prepare('DELETE FROM news WHERE id = :id');
								$req->bindParam(':id', $_POST['id']);
								$req->execute();
								echo '<div class="alert alert-success"><p>Article supprimé !</p></div>';
							} catch (Exception $e) {
								die('<div class="alert alert-error"><p>Il a eu une erreur... On a tout pété !</p><div class="well">' . $e->getMessage() .'</div></div>');
							}
						} else if(empty($_POST['articleTitle']) OR empty($_POST['articleContent']))  // Si on envoie un article sans titre ou contenu, bah stop.
							echo('<div class="alert alert-error"><p>Titre ou article vide ?</div>');
						} else if(isset($_POST["edit"])) { // Si on demande à éditer
							try {
								$req = $bdd->prepare('UPDATE `news` SET `titre` = :titre, `article` = :article, `date` = :date, `edited` = "1" WHERE `id` = :id');
								$req->bindParam(':titre', $_POST['articleTitle']);
								$req->bindParam(':date', $date);
								$req->bindParam(':article', $_POST['articleContent']);
								$req->bindParam(':id', $_POST['articleID']);
								$req->execute();
								echo '<div class="alert alert-success"><p>Article édité !</p></div>';
							} catch (Exception $e) {
								die('<div class="alert alert-error"><p>Il a eu une erreur... On a tout pété !</p><div class="well">' . $e->getMessage() .'</div></div>');
							}
						} else { // Sinon dernier cas, bah on envoie l'article :D
							$slug = slug($_POST['articleTitle']); // Créer le slug
							try {
								$req = $bdd->prepare('INSERT INTO news(titre, date, slug, article) VALUES(:titre,:date,:slug,:article)');
								$req->bindParam(':titre', $_POST['articleTitle']);
								$req->bindParam(':date', $date);
								$req->bindParam(':slug', $slug);
								$req->bindParam(':article', $_POST['articleContent']);
								$req->execute();
								echo '<div class="alert alert-success"><p>Article "<b>'. $_POST['articleTitle'] .'</b>" publié !</p></div>';
							} catch (Exception $e) {
								die('<div class="alert alert-error"><p>Il a eu une erreur... On a tout pété !</p><div class="well">' . $e->getMessage() .'</div></div>');
							}
						}
					}
					?>

					<div class="panel panel-danger">
						<div class="panel-heading">
							<h3 class="panel-title"><strong>ADMIN</strong></h3>
						</div>
						<div class="panel-body">
							<h2>Bienvenue !</h2>
							<a href="add.php" class="btn btn-primary btn-sm"><i class="ionicons ion-checkmark-round">&nbsp;</i> Créer un nouvel article</a>
							<ul class="list-group">
							<?php
							// Afficher toute la liste d'article avec les boutons éditer ou supprimer
							$reponse = $bdd->query("SELECT id,titre FROM news ORDER BY id DESC");
							while ($donnees = $reponse->fetch()) {
								echo '
								<li class="list-group-item">
									<span class="badge"><a href="delete.php?id='. $donnees["id"] .'">&nbsp;<i class="ionicons ion-trash-a"></i>&nbsp;</a></span>
									<span class="badge"><a href="edit.php?id='. $donnees["id"] .'">&nbsp;<i class="ionicons ion-edit"></i>&nbsp;</a></span>
									'. $donnees["titre"] .'
								</li>
								';
							} // fin while
							?>
							</ul>
						</div>
					</div>

				</div> <!-- //.bs-component -->
			</div> <!-- //.col-lg-9 -->

<?php require '../includes/footer.php'; ?>
