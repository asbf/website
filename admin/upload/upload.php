<?php
date_default_timezone_set('Europe/Paris');

// HTTPS PLZ!
if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){ // Petit forçage de l'HTTPS
	if($_SERVER['HTTP_HOST'] != "asbf.dev") { // Si on développe en local, ne pas passer en HTTPS
		header('Location: https://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		die('Redirection en HTTPS');
	}
}

$ds          = DIRECTORY_SEPARATOR; // à cause des différences Windows (\) et Unix (/).
$storeFolder = $ds .'..'. $ds .'..'. $ds .'uploads'. $ds; // équivaut à `/../../uploads/`

if (!empty($_FILES)) {
	$tempFile = $_FILES['file']['tmp_name'];
	// Equivalent à `/admin/uploads/../../uploads/` ou, par ex., `/var/www/asbf/uploads/`
	$targetPath = dirname( __FILE__ ) . $storeFolder;
	// Ajouter un nombre aléatoire devant le nom du fichier, éviter les fichiers au même nom
	$name = rand(1, 99999) .'_'. $_FILES['file']['name']; 
	$targetFile =  $targetPath . $name ;
	move_uploaded_file($tempFile, $targetFile); // déplacer le fichier du dossier temporaire
	// Retourner le code à insérer dans l'article. Ex. `![nom.jpg](//asbf.fr/uploads/4588_nom.jpg)`
	echo '!['. $_FILES['file']['name'] .'](//'. $_SERVER['HTTP_HOST'] .'/uploads/'. $name .')';
}
