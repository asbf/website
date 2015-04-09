<?php require '../includes/header.php';
require '../includes/nav.php'; ?>

				<!-- Contenu -->
				<div class="col-lg-9">
					<div class="bs-component">

						<form method="post" action="contactengine.php" class="form-horizontal">
							<fieldset>
								<legend>CONTACT</legend>

								<div class="form-group">
									<label for="select" class="col-lg-2 control-label">Qui contacter</label>
									<div class="col-lg-10">
										<select class="form-control" id="select" name="select">
											<option value="0" selected disabled>Choisissez...</option>
											<option value="1">Bureau</option>
											<option value="2">Secrétaire</option>
											<option value="3">Trésorier</option>
											<option value="4">Technique/Webmestre</option>
											<option value="5">Je ne sais pas...</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="nom" class="col-lg-2 control-label">Nom, Prénom</label>
									<div class="col-lg-10">
										<input type="text" class="form-control" id="nom" name="nom" placeholder="Votre nom et prénom OU votre pseudo">
									</div>
								</div>

								<div class="form-group">
									<label for="email" class="col-lg-2 control-label">Email</label>
									<div class="col-lg-10">
										<input type="email" class="form-control" id="email" name="email" placeholder="Votre email, à vous, pour vous recontacter">
									</div>
								</div>

								<div class="form-group">
									<label for="message" class="col-lg-2 control-label">Message</label>
									<div class="col-lg-10">
										<textarea class="form-control" rows="3" id="message" name="message"></textarea>
									</div>
								</div>

								<div class="form-group">
									<div class="col-lg-10 col-lg-offset-2">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="self"> Recevoir une copie ?
											</label>
										</div>
										<input type="text" style="position: absolute; left: -9999px; opacity: 0;" id="captcha" name="captcha" placeholder="LAISSEZ CE CHAMP VIDE">
										<br>
										<button type="reset" class="btn btn-default">Vider</button>
										<button type="submit" class="btn btn-primary">Envoyer</button>
									</div>
								</div>
							</fieldset>
						</form>

					</div> <!-- //.bs-component -->
				</div> <!-- //.col-lg-9 -->

<?php require '../includes/footer.php'; ?>
