<?php
session_start();
isset($_SESSION['logged']) ? : $_SESSION['logged'] = false;
require("asbf.class.php");
require("../includes/logins.php");
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

<?php
if(isset($_POST['user']) && isset($_POST['password'])) {
	if($_POST['user'] == $user && $_POST['password'] == $password) {
		$_SESSION['logged'] = true;
		header("Location: ./admin.php");
	} else {
		echo "err";
	}
} else if($_SESSION['logged']) {
	header("Location: ./admin.php");
} else { ?>
	<div id="login">
		<form action="admin.php" method="post">
			<input type="text" name="user" placeholder="Identifiant">
			<input type="password" name="password" placeholder="Mot de passe">
			<input type="submit" value="Connexion">
		</form>
	</div>
<?php } ?>
</body>

</html>
