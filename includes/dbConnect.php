
<?php
require 'logins.php';
try {
	$bdd = new PDO('mysql:host='. $dbHost .';dbname='. $dbName .';charset=utf8', $dbUser , $dbPass);
} catch(Exception $e) {
	die('Oops. Something went wrong!<br> ' . $e->getMessage());
}