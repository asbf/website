<?php require '../includes/header.php';
require '../includes/nav.php'; ?>

				<!-- Contenu -->
				<div class="col-lg-9">
					<div class="bs-component">

						<div class="panel panel-primary">
							<div class="panel-heading">
								<h3 class="panel-title"><strong>ACTUALITÉS</strong></h3>
							</div>
							<div class="panel-body">
								<p>
									<ul class="news">
									<?php
										// Foreach news
									?>
										<li>
											<span class="title"><a href="/news/#">Lorem ipsum dolor sit amet</a></span>
											<span class="date">date</span>
										</li>
									<?php
										// Fin foreach
									?>
										<li>
											<span class="title"><a href="/news/#">Lorem ipsum dolor sit amet</a></span>
											<span class="date">date</span>
										</li>
									</ul>
								</p>
							</div>
						</div>

					</div> <!-- //.bs-component -->
				</div> <!-- //.col-lg-9 -->

<?php require '../includes/footer.php'; ?>
