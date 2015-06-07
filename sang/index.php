<?php
require("asbf.class.php");
$total = $asbf->getTotal();
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

	<section class="intro">
		<p class="bold">13 et 14 Juin 2015, pour la journée mondiale des donneurs de sang.</p>
		<p>Rejoins les Bronies de ton secteur, donne ton sang, sauve des vies.</p>
	</section>

	<section class="main">
		<div id="count">
			<div class="total"><?= $total; ?></div>
		</div>
	</section>

	<hr/>

	<section class="info">
		<p class="bold">Rejoins une collecte près de chez toi</p>
		<?php foreach ($asbf->getCollectes() as $key => $collecte): ?>
		<div class="collecte">
			<p class="city"><?= $collecte['lieu']; ?></p>
			<p class="desc"><?= $collecte['description']; ?></p>
			<p class="adresse"><?= $collecte['adresse']; ?></p>
			<p class="heure"><?= date("H:i",strtotime($collecte['heure_debut'])) . " - " . date("H:i",strtotime($collecte['heure_fin'])); ?></p>
		</div>
		<?php endforeach; ?>
	</section>

	<div style="display:none;" id="level"><?= $total; ?></div>
</body>
</html>
