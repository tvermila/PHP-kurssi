<?php
require_once 'albumi.php';

class albumiPDO {
	private $db;

	function __construct($dsn="mysql:host=localhost;dbname=a1602794",
						$user="phpmyadmin", $pwd="mysqlpwd") {

	//Otetaan yhteys kantaan
	$this->db = new PDO($dsn, $user, $pwd);
	//Virheiden tarkistus päälle
	$this->db->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// MySQL injection estoon (paramerit sidotaan PHP:ssä ennen SQL-palvelimelle lähettämistä)
	$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}

	public function kaikkiAlbumit() {
		try{
			$sql = "SELECT id, yhtye, nimi, julkaisuvuosi, levyYhtio, url, lisatietoja FROM albumit";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();

			$tulos = array();
			while ($row = $stmt->fetchObject()) {
				$albumi = new Albumi();
				$albumi->setId($row->id);
				$albumi->setYhtye($row->yhtye);
				$albumi->setNimi($row->nimi);
				$albumi->setJulkaisuvuosi($row->julkaisuvuosi);
				$albumi->setLevyYhtio($row->levyYhtio);
				$albumi->setUrl($row->url);
				$albumi->setLisatietoja($row->lisatietoja);
				$tulos[] = $albumi;
			}
		}catch (PDOException $e){
			print($e->getMessage());
		}
		return $tulos;
		}

		public function etsiAlbumi($id) {
			try{
				$sql = "SELECT id, yhtye, nimi, julkaisuvuosi, levyYhtio, url, lisatietoja FROM albumit WHERE id=:id";
				$stmt = $this->db->prepare($sql);
				$stmt->bindValue(":id", $id, PDO::PARAM_INT);
				$stmt->execute();

				$tulos = $stmt->fetchObject();
				$albumi = new Albumi();
				$albumi->setId($tulos->id);
				$albumi->setYhtye($tulos->yhtye);
				$albumi->setNimi($tulos->nimi);
				$albumi->setJulkaisuvuosi($tulos->julkaisuvuosi);
				$albumi->setLevyYhtio($tulos->levyYhtio);
				$albumi->setUrl($tulos->url);
				$albumi->setLisatietoja($tulos->lisatietoja);
			}catch (PDOException $e){
				print($e->getMessage());
			}
			return $albumi;
			}

		public function poistaAlbumi($id) {
			try{
				$sql = "DELETE FROM albumit WHERE id=:id";
				$stmt = $this->db->prepare($sql);
				$stmt->bindValue(":id", $id, PDO::PARAM_INT);
				$stmt->execute();
			}catch (PDOException $e){
				print($e->getMessage());
			}
		}

		public function haeAlbumit($hakusana) {
			try{
				$sql = "SELECT id, yhtye, nimi, julkaisuvuosi, levyYhtio, url, lisatietoja FROM albumit WHERE nimi LIKE :hakusana";
				$stmt = $this->db->prepare($sql);
				$hs = "%" . $hakusana . "%";
				$stmt->bindValue(":hakusana", $hs, PDO::PARAM_STR);
				$stmt->execute();

				$tulos = array();
				while ($row = $stmt->fetchObject()) {
					$albumi = new Albumi();
					$albumi->setId($row->id);
					$albumi->setYhtye($row->yhtye);
					$albumi->setNimi($row->nimi);
					$albumi->setJulkaisuvuosi($row->julkaisuvuosi);
					$albumi->setLevyYhtio($row->levyYhtio);
					$albumi->setUrl($row->url);
					$albumi->setLisatietoja($row->lisatietoja);
					$tulos[] = $albumi;
				}
			}catch (PDOException $e){
				print($e->getMessage());
			}
			return $tulos;
		}

		public function lisaaAlbumi($uusiAlbumi) {
			try{
				$sql = "INSERT INTO albumit (yhtye, nimi, julkaisuvuosi, levyYhtio, url, lisatietoja)
						VALUES (:yhtye, :nimi, :julkaisuvuosi, :levyYhtio, :url, :lisatietoja)";
				$stmt = $this->db->prepare($sql);
				$stmt->bindValue(":yhtye", $uusiAlbumi->getYhtye(), PDO::PARAM_STR);
				$stmt->bindValue(":nimi", $uusiAlbumi->getNimi(), PDO::PARAM_STR);
				$stmt->bindValue(":julkaisuvuosi", $uusiAlbumi->getJulkaisuvuosi(), PDO::PARAM_INT);
				$stmt->bindValue(":levyYhtio", $uusiAlbumi->getLevyYhtio(), PDO::PARAM_STR);
				$stmt->bindValue(":url", $uusiAlbumi->getUrl(), PDO::PARAM_STR);
				$stmt->bindValue(":lisatietoja", $uusiAlbumi->getLisatietoja(), PDO::PARAM_STR);
				$stmt->execute();
			}catch (PDOException $e){
				print($e->getMessage());
			}			
		}
}
