<?php
date_default_timezone_set('Europe/Paris');

// HTTPS PLZ!
if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){ // Petit forçage de l'HTTPS
	if($_SERVER['HTTP_HOST'] != "asbf.dev") { // Si on développe en local, ne pas passer en HTTPS
		header('Location: https://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		die('Redirection en HTTPS');
	}
}
?>
<!DOCTYPE html>
<!-- http://bootswatch.com/cosmo/ -->
<html lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<title>Upload - Actions Solidaires Brony Francophone</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/css/bootstrap.css" media="screen">
	<link rel="stylesheet" href="dropzone.css" media="screen">
	<link rel="stylesheet" href="/css/custom.css" media="screen">
	<link rel="stylesheet" href="/css/ionicons.min.css" media="screen">
	<style>#result {display: none;}</style>
	<script src="dropzone.js"></script>
	<script>
	Dropzone.options.uploadMe = {
		acceptedFiles: "image/*,application/pdf,application/ms*,application/x-msexcel,application/x-excel",
		dictDefaultMessage: "Glissez-déposez les images ici (ou cliquez)",
		init: function() {
			this.on("success", function(file, serverResp) {
				var div = document.getElementById('result');
				div.style.display = 'block';
				div.innerHTML = div.innerHTML + '<br>' + serverResp;
			});
		}
	};
	</script>
</head>

<body>

	<form action="upload.php" class="dropzone" id="uploadMe"></form>
	<div id="result" class="well">
		<b>A coller pour afficher l'image (retirez le point d'exclamation pour en faire un lien)</b><br>
	</div>

</body>
</html>
