<?php
// HTTPS PLZ!
if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){ // Petit forçage de l'HTTPS
	if($_SERVER['HTTP_HOST'] != "asbf.dev") { // Si on développe en local, ne pas passer en HTTPS
		header('Location: https://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		die('Redirection en HTTPS');
	}
}

if(isset($_GET['id'])) $get = $_GET['id'];

require '../includes/dbConnect.php';
if(!empty($get)) {
	$reponse = $bdd->query("SELECT * FROM news WHERE `id` = '$get'");
	$donnees = $reponse->fetch();
	$markdownEditor = true;
} else {
	$reponse = $bdd->query("SELECT * FROM news ORDER BY id DESC");
}

require '../includes/header.php';
require '../includes/nav.php';
?>

			<!-- Contenu -->
			<div class="col-lg-9">
				<div class="bs-component">

					<div class="panel panel-danger">
						<div class="panel-heading">
							<h3 class="panel-title"><a href="/admin/"><i class="ionicons ion-arrow-left-c"></i></a> &nbsp; <strong>ADMIN</strong></h3>
						</div>
						<div class="panel-body">

							<form method="post" action="index.php" class="form-horizontal">
								<fieldset>
									<legend>Ajouter un article</legend>
									<div class="form-group">
										<label for="articleTitle" class="col-lg-1 control-label">Titre</label>
										<div class="col-lg-11">
											<input type="text" class="form-control" name="articleTitle" id="articleTitle" maxlength="50" required
											placeholder="Titre de l'article" value="<?php echo $donnees['titre']; ?>">
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-2 col-lg-offset-10">
											<a onclick="return popitup('/admin/upload/')" href="#" class="btn btn-primary btn-sm"><i class="ionicons ion-android-upload">&nbsp;</i> Upload image</a>
										</div>
										<div class="col-lg-11 col-lg-offset-1">
											<textarea class="form-control" name="articleContent" id="articleContent" rows="15"><?php echo $donnees['article']; ?></textarea>
											<script>var editor = new Editor(); editor.render();</script>
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-11 col-lg-offset-1">
											<input type="hidden" style="display: none;" name="articleID" value="<?php echo $get;  ?>"/>
											<input type="hidden" style="display: none;" name="edit" value="1"/>
											<button type="submit" class="btn btn-primary">Envoyer</button>
										</div>
									</div>
								</fieldset>
							</form>

						</div>
					</div>

				</div> <!-- //.bs-component --
			</div> <!-- //.col-lg-9 -->

<?php require '../includes/footer.php'; ?>
