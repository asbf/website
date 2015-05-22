<?php
if(isset($_GET['post'])) $get = $_GET['post'];

require '../includes/dbConnect.php';
if(!empty($get)) {
	$reponse = $bdd->query("SELECT * FROM news WHERE `slug` = '$get'");
	$donnees = $reponse->fetch();
	$subTitle = $donnees["titre"];
} else {
	$reponse = $bdd->query("SELECT * FROM news ORDER BY id DESC");
}

require '../includes/header.php';
require '../includes/nav.php';
require '../includes/date.php';

require '../includes/parsedown/Parsedown.php';
require '../includes/parsedown-extra/ParsedownExtra.php';
$md = new ParsedownExtra();
?>

			<!-- Contenu -->
			<div class="col-lg-9">
				<div class="bs-component">

					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title"><strong>ACTUALITÉS</strong></h3>
						</div>
						<div class="panel-body">
							<?php
							if(empty($get)) {
								$currentDate = new DateTime();
								echo '
							<ul class="news">';
							while ($donnees = $reponse->fetch()) {
								$postDate = new DateTime($donnees["date"]);
								$displayDate = ""; // initialiser
								if($donnees['edited']) $displayDate = "<sup>édité</sup> ";
								$displayDate .= dateHMDMY($donnees["date"]);
								if ($postDate < $currentDate) {
									echo '
								<li>
									<span class="date">'. $displayDate .'</span>
									<span class="title"><a href="/news/?post='. $donnees["slug"] .'">'. $donnees["titre"] .'</a></span>
								</li>
									';
								}
							} // fin while

							echo '
							</ul>
							';
							} else {
								$displayDate = ""; // initialiser
								if($donnees['edited']) $displayDate = "<sup>édité</sup> ";
								$displayDate .= dateHMDMY($donnees["date"]);
								echo '
							<a href="/news/" class="btn btn-primary btn-sm"><i class="ionicons ion-arrow-left-c">&nbsp;</i> Revenir à la liste</a>
							<div class="news">
								<span class="date">'. $displayDate .'</span>
								<h1>'. $donnees["titre"] .'</h1>
								<div class="art">'. $md->setBreaksEnabled(true)->text($donnees["article"]) .'</div>
							</div>
								';
							}
							?>

						</div>
					</div>

				</div> <!-- //.bs-component -->
			</div> <!-- //.col-lg-9 -->

<?php require '../includes/footer.php'; ?>
