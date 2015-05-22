<?php
date_default_timezone_set('Europe/Paris');

// HTTPS PLZ!
if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){ // Petit forçage de l'HTTPS
	if($_SERVER['HTTP_HOST'] != "asbf.dev") { // Si on développe en local, ne pas passer en HTTPS
		header('Location: https://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
		die('Redirection en HTTPS');
	}
}

$ds          = DIRECTORY_SEPARATOR;
$storeFolder = $ds .'..'. $ds .'..'. $ds .'uploads'. $ds;

if (!empty($_FILES)) {
	$tempFile = $_FILES['file']['tmp_name'];
	$targetPath = dirname( __FILE__ ) . $storeFolder;
	$name = rand(1, 99999) .'_'. $_FILES['file']['name'];
	$targetFile =  $targetPath . $name ;
	move_uploaded_file($tempFile, $targetFile);
	echo '!['. $_FILES['file']['name'] .'](//'. $_SERVER['HTTP_HOST'] .'/uploads/'. $name .')';
}
