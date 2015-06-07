<?php
class ASBF{
	private function mysql_connect() {
		require("../includes/dbConnect.php");
		$bdd->query('SET NAMES utf8');
		return $bdd;
	}

	public function query($sql) {
		$bdd = $this->mysql_connect();
		$req = $bdd->query($sql);
		return $req;
	}

	public function getTotal() {
		$total = $this->query("SELECT SUM(resultat) as total FROM collecte");
		return $total->fetch()['total'];
	}

	public function getCollectes() {
		$collectes = $this->query("SELECT * FROM collecte ORDER BY lieu");
		return $collectes->fetchAll();
	}

	public function updateCollecte($collecte_id, $collecte_result) {
		$this->query("UPDATE collecte SET resultat = '$collecte_result' WHERE id = $collecte_id");
		return true;
	}
}

$asbf = new ASBF();
