<?php
session_start();
isset($_SESSION['logged']) ? : header("Location: ./login.php");
require("asbf.class.php");

if(isset($_POST['update'])) {
	echo $asbf->updateCollecte($_POST['collecte_id'], $_POST['collecte_result']);
	die();
}

$total = $asbf->getTotal();
$collectes = $asbf->getCollectes();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, maximum-scale=1.0">
	<title>ASBF | Don du sang</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/style.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/client.js"></script>
</head>
<body>
	<header>
		<input style="display: none;" type="range" min="0" max="50" id="adjust" />
		<img id="logo" src="img/logo.png" />
	</header>

	<form id="admin" action="">
		<p class="flash" style="display: none;"></p>
		<p class="bold">Administration :</p>
		<select name="collecte" id="collecte">
		<optgroup label="Selectionner une collecte">
		<option value="0">--------</option>
		<?php foreach ($collectes as $key => $collecte): ?>
			<option value="<?= $collecte['id']; ?>"><?= $collecte['lieu']; ?></option>
		<?php endforeach; ?>
		</optgroup>
		</select>

		<?php foreach ($collectes as $key => $collecte): ?>
			<input class="resultat" style="display: none;" data-collecte-id="<?= $collecte['id']; ?>" type="number" value="<?= $collecte['resultat']; ?>">
		<?php endforeach; ?>
		<input type="submit" value="Envoyer">
	</form>
</body>
</html>
