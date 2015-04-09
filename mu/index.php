<?php require '../includes/header.php';
require '../includes/nav.php'; ?>



						<div class="modal" id="proposer" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<a type="button" class="close" href="#close" aria-hidden="true">×</a>
										<h4 class="modal-title">Proposer un meet-up</h4>
									</div>
									<div class="modal-body">

										<form method="post" action="contactengine.php" class="form-horizontal">
											<fieldset>
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
													<label for="date" class="col-lg-2 control-label">Date</label>
													<div class="col-lg-10">
														<input type="date" class="form-control" id="date" name="date" placeholder="31/12/2015">
													</div>
												</div>

												<div class="form-group">
													<label for="lieu" class="col-lg-2 control-label">Lieu</label>
													<div class="col-lg-10">
														<input type="text" class="form-control" id="lieu" name="lieu" placeholder="Lieu de l'évènement">
													</div>
												</div>

												<div class="form-group">
													<label for="asso" class="col-lg-2 control-label">Nom de l'action</label>
													<div class="col-lg-10">
														<input type="text" class="form-control" id="asso" name="asso" placeholder="Association aidée ou action rejointe">
													</div>
												</div>

												<div class="form-group">
													<label for="website" class="col-lg-2 control-label">Site web</label>
													<div class="col-lg-10">
														<input type="text" class="form-control" id="website" name="website" placeholder="Site de l'association ou de l'action">
													</div>
												</div>

												<div class="form-group">
													<label for="descriptif" class="col-lg-2 control-label">Descriptif du meet-up solidaire</label>
													<div class="col-lg-10">
														<textarea class="form-control" rows="3" id="descriptif" name="descriptif"></textarea>
														<span class="help-block">Détaillez au mieux les informations et le but !</span>
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
														<a type="reset" class="btn btn-default" href="#close">Annuler</a>
														<button type="submit" class="btn btn-primary">Envoyer</button>
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


						<div class="panel panel-warning">
							<div class="panel-heading">
								<h3 class="panel-title"><strong>MEET-UPS</strong></h3>
							</div>
							<div class="panel-body">
								<a href="#proposer">Proposer un meet-up</a>
								<p>
									<div class="list-group mu">
										<?php
											// Foreach news
										?>
										<a href="#" class="list-group-item">
											<span class="image">image</span>
											<h4 class="list-group-item-heading">Titre</h4>
											<p class="list-group-item-text date">Date</p>
											<p class="list-group-item-text desc">
												Descriptif
											</p>
											<p class="list-group-item-text lieu">
												Lieu
											</p>
										</a>
										<?php
											// Fin foreach
										?>
										<a href="#" class="list-group-item">
											<span class="image">image</span>
											<h4 class="list-group-item-heading">Titre</h4>
											<p class="list-group-item-text date">Date</p>
											<p class="list-group-item-text desc">
												Descriptif
											</p>
											<p class="list-group-item-text lieu">
												Lieu
											</p>
										</a>
									</div>
								</p>
							</div>
						</div>

					</div> <!-- //.bs-component -->
				</div> <!-- //.col-lg-9 -->

<?php require '../includes/footer.php'; ?>
