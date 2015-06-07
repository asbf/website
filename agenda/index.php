<?php
if(isset($_GET['success'])) $success = 1;
if(isset($_GET['bot'])) $bot = 1;
if(!empty($_GET['error'])) $error = urldecode($_GET['error']);

require '../includes/header.php';
require '../includes/nav.php';
?>

			<!-- MODAL -- Petite popup avec le formulaire -->
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
							<a href="#proposer" class="btn btn-primary btn-sm"><i class="ionicons ion-lightbulb">&nbsp;</i> Proposer un évènement</a>
							<div class="list-group agenda">

								<?php
								// Read from the cache, see cron.php
								$cacheFileCal = fopen("../cache/events.html", "r") or dir("Pas possible de voir la liste pour le moment :(");
								echo fread($cacheFileCal, filesize("../cache/events.html"));
								fclose($cacheFileCal);
								?>

							</div>
						</div>
					</div>

				</div> <!-- //.bs-component -->
			</div> <!-- //.col-lg-9 -->

<?php require '../includes/footer.php'; ?>
