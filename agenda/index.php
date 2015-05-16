<?php
if(isset($_GET['success'])) $success = 1;
if(isset($_GET['bot'])) $bot = 1;
if(!empty($_GET['error'])) $error = urldecode($_GET['error']);
if(isset($_GET['post'])) $get = $_GET['post'];

require '../includes/date.php';
require '../includes/dbConnect.php';
if(!empty($get)) {
	$reponse = $bdd->query("SELECT * FROM agenda WHERE `slug` = '$get'");
	$donnees = $reponse->fetch();
	$subTitle = $donnees["titre"];
} else {
	$reponse = $bdd->query("SELECT * FROM agenda WHERE dateend >= CURDATE() ORDER BY datestart ASC");
}

require '../includes/header.php';
require '../includes/nav.php';

require '../includes/parsedown/Parsedown.php';
require '../includes/parsedown-extra/ParsedownExtra.php';
$md = new ParsedownExtra();
?>

			<div class="modal" id="proposer" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<a type="button" class="close" href="#close" aria-hidden="true">×</a>
							<h4 class="modal-title">Proposer un évènement</h4>
						</div>
						<div class="modal-body">

							<form method="post" action="contactengine.php" class="form-horizontal">
								<fieldset>
									<div class="form-group">
										<label for="nom" class="col-lg-2 control-label">Nom, Prénom</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom et prénom OU votre pseudo" required>
										</div>
									</div>

									<div class="form-group">
										<label for="email" class="col-lg-2 control-label">Email</label>
										<div class="col-lg-10">
											<input type="email" class="form-control" id="email" name="email" placeholder="Votre email, à vous, pour vous recontacter" required>
										</div>
									</div>

									<div class="form-group">
										<label for="date" class="col-lg-2 control-label">Date</label>
										<div class="col-lg-10">
											<input type="date" class="form-control" id="date" name="date" placeholder="31/12/2015" autocomplete="off" required>
										</div>
									</div>

									<div class="form-group">
										<label for="lieu" class="col-lg-2 control-label">Lieu</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" id="lieu" name="lieu" placeholder="Lieu de l'évènement" autocomplete="off" required>
										</div>
									</div>

									<div class="form-group">
										<label for="asso" class="col-lg-2 control-label">Nom de l'action</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" id="asso" name="asso" placeholder="Association aidée ou action rejointe" autocomplete="off" required>
										</div>
									</div>

									<div class="form-group">
										<label for="website" class="col-lg-2 control-label">Site web</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" id="website" name="website" placeholder="Site de l'association ou de l'action" autocomplete="off">
										</div>
									</div>

									<div class="form-group">
										<label for="descriptif" class="col-lg-2 control-label">Descriptif du meet-up solidaire</label>
										<div class="col-lg-10">
											<textarea class="form-control" rows="3" id="descriptif" name="descriptif" required></textarea>
											<span class="help-block">Détaillez au mieux les informations et le but !</span>
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-10 col-lg-offset-2">
											<div class="checkbox">
												<label>
													<input type="checkbox" name="self" value="1"> Recevoir une copie ?
												</label>
											</div>
											<input type="text" style="position: absolute; left: -9999px; opacity: 0;" id="captcha" name="captcha" placeholder="LAISSEZ CE CHAMP VIDE">
											<br>
											<a type="reset" class="btn btn-default btn-sm" href="#close">Annuler</a>
											<button type="submit" class="btn btn-primary btn-sm">Envoyer</button>
										</div>
									</div>
								</fieldset>
							</form>

						</div>
					</div>
				</div>
			</div>


			<!-- Contenu -->
			<div class="col-lg-9">
				<div class="bs-component">

				<?php
				if(isset($success)) echo '
					<div class="alert alert-success">
						<h4>Envoyé !</h4>
						<p>Merci pour votre message, il a bien été envoyé !</p>
					</div>
				';
				if(isset($bot)) echo '
					<div class="alert alert-warning">
						<h4>Attention !</h4>
						<p>Avez-vous bien rempli tout les champs nécessaire ?</p>
					</div>
				';
				if(!empty($error)) echo '
					<div class="alert alert-danger">
						<h4>Oh, erreur !</h4>
						<p>Revérifiez votre entrée et réessayez. <br><i>Au cas-où, voici l\'erreur : '. $error .'</i></p>
					</div>
				';
				?>


					<div class="panel panel-warning">
						<div class="panel-heading">
							<h3 class="panel-title"><strong>AGENDA</strong></h3>
						</div>
						<div class="panel-body">

							<?php
							if(empty($get)) {
								echo'
							<a href="#proposer" class="btn btn-primary btn-sm"><i class="ionicons ion-lightbulb">&nbsp;</i> Proposer un évènement</a>
							<p>
								<div class="list-group agenda">';
								$count = 0;
								while($donnees = $reponse->fetch()) {
									echo '
									<a href="?post='. $donnees["slug"] .'" class="list-group-item">';
										if(!empty($donnees['img'])) echo '<img class="image" src="'. $donnees["img"] .'">';
										echo '<h4 class="list-group-item-heading">'. $donnees["titre"] .'</h4>
										<p class="list-group-item-text date">'. dateToDate($donnees["datestart"], $donnees["dateend"]) .'</p>
										<p class="list-group-item-text lieu"><b>Lieu :</b> '. $donnees["lieu"] .'</p>
									</a>
									';
									$count++;
								} // fin while

								if($count == 0){
									echo '
									<span class="list-group-item">
										<h4 class="list-group-item-heading">Aucun évènement futur prévu (pour l\'instant)</h4>
									</span>
									';
								}
							} else {
								echo '
							<a href="/agenda/" class="btn btn-primary btn-sm"><i class="ionicons ion-arrow-left-c">&nbsp;</i> Revenir à la liste</a>
							<div class="agenda">';
								if(!empty($donnees['img'])) echo '<img class="image" src="'. $donnees['img'] .'">';
								echo '<h4>'. $donnees['titre'] .'</h4>
								<span class="date">'. dateToDate($donnees["datestart"], $donnees["dateend"]) .'</span><br
								<span class="lieu"><b>Lieu :</b> '. $donnees["lieu"] .'</span>
								<div class="desc">'. $md->text($donnees["description"]) .'</div>
							</div>
								';
							}
							?>

						</div>
					</div>

				</div> <!-- //.bs-component -->
			</div> <!-- //.col-lg-9 -->

<?php require '../includes/footer.php'; ?>
