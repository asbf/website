<?php
if(isset($_GET['post'])) $get = $_GET['post'];

require '../includes/date.php';
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
								echo '
							<ul class="news">';
							while ($donnees = $reponse->fetch()) {
								echo '
								<li>
									<span class="date">'. dateHMDMY($donnees["date"]) .'</span>
									<span class="title"><a href="/news/?post='. $donnees["slug"] .'">'. $donnees["titre"] .'</a></span>
								</li>
								';
							} // fin while
							
							echo '
							</ul>
							';
							} else {
								echo '
							<a href="/news/" class="btn btn-primary btn-sm"><i class="ionicons ion-arrow-left-c">&nbsp;</i> Revenir à la liste</a>
							<div class="news">
								<span class="date">'. dateHMDMY($donnees["date"]) .'</span>
								<h4>'. $donnees["titre"] .'</h4>
								<div class="art">'. $md->text($donnees["article"]) .'</div>
							</div>
								';
							} 
							?>
							
						</div>
					</div>

				</div> <!-- //.bs-component -->
			</div> <!-- //.col-lg-9 -->

<?php require '../includes/footer.php'; ?>
