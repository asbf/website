<?php
require './includes/date.php';
require './includes/dbConnect.php';
$reponse = $bdd->query("SELECT * FROM news ORDER BY id DESC LIMIT 3");

require './includes/header.php';
require './includes/nav.php';
?>

			<!-- Contenu -->
			<div class="col-lg-9">
				<div class="bs-component">

					<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title"><strong>BIENVENUE</strong></h3>
						</div>
						<div class="panel-body">
							<p>
								<b>Actions Solidaires Brony Francophone</b> (ASBF) est une association dont l’objectif est l’organisation d’actions solidaires diverses. Son ambition est d’apporter une aide humaine aux autres, ainsi que d’aider à la prise de conscience de chacun envers ces actions par la diffusion d’informations.<br>
								<br>
								Son nom a pour origine la communauté Brony. Cette association s’inspire de <a target="_blank" href="http://broniesforgood.org/">Bronies for Good</a>, (association solidaire basée aux États-Unis), et couvre quant à elle la zone francophone. L’ASBF est partenaire de Bronies for Good depuis sa création, avec pour objectif des actions humataires internationales.
							</p>
							<p>
								Pour tout contact, vous pouvez nous envoyer un mail à <noscript>contact [~at~] asbf.fr</noscript>
								<script type="text/javascript">
								// Email obfuscator script 2.1 by Tim Williams, University of Arizona http://www.jottings.com/obfuscator/
								for(coded="lhIR9lR@9d5S.SN",key="Une20aJSvmY3qgHsICLp9bcT87jKoDdzPOBk5lW64GthQrxMFEVuyAfZwRX1Ni",shift=coded.length,link="",i=0;i<coded.length;i++)-1==key.indexOf(coded.charAt(i))?(ltr=coded.charAt(i),link+=ltr):(ltr=(key.indexOf(coded.charAt(i))-shift+key.length)%key.length,link+=key.charAt(ltr));document.write("<a href='mailto:"+link+"'>contact [~at~] asbf.fr</a>");
								</script>
							</p>
						</div>
					</div>

					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title"><strong>DERNIÈRES ACTUALITÉS</strong></h3>
						</div>
						<div class="panel-body">
							<p>
								<ul class="news">
								<?php
								while ($donnees = $reponse->fetch()) {
								$postDate = new DateTime($donnees["date"]);
								if ($postDate < $currentDate) {
									echo '
									<li>
										<span class="title"><a href="/news/?post='. $donnees["slug"] .'">'. $donnees["titre"] .'</a></span>
										<span class="date">'. dateHMDMY($donnees["date"]) .'</span>
									</li>
										';
									}
								} // fin while
								?>
								</ul>
							</p>
						</div>
					</div>

					<!--<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title"><strong>PARTENAIRES</strong></h3>
						</div>
						<div class="panel-body">
							<p>
								Lorem ipsum dolor sit amet
							</p>
						</div>
					</div>-->

				</div> <!-- //.bs-component -->
			</div> <!-- //.col-lg-9 -->

<?php require './includes/footer.php'; ?>
