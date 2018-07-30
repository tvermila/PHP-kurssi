<?php
class Albumi implements JsonSerializable {
	
	// Luokan muuttujat
	private $yhtye, $nimi, $julkaisuvuosi, $levyYhtio, $url, $lisatietoja, $id;
	private $error = 0;

	
	// Metodi, mikä muuttaa olion JSON-muotoon
	public function jsonSerialize() {
		return array (
				"yhtye" => $this->yhtye,
				"nimi" => $this->nimi,
				"julkaisuvuosi" => $this->julkaisuvuosi,
				"levyYhtio" => $this->levyYhtio,
				"url" => $this->url,
				"lisatietoja" => $this->lisatietoja
		);
	}
	
	// Konstruktori
	function __construct($yhtye="", $nimi="", $julkaisuvuosi="", $levyYhtio="",
			$url="", $lisatietoja="", $id=0) {
		$this->yhtye = trim($yhtye);
		$this->nimi = trim($nimi);
		$this->julkaisuvuosi = trim($julkaisuvuosi);
		$this->levyYhtio = trim($levyYhtio);
		$this->url = trim($url);
		$this->lisatietoja = trim($lisatietoja);
		$this->id = $id;
		}
	
	public function getYhtye() {
		return $this->yhtye;
	}
	
	public function setYhtye($yhtye) {
		$this->yhtye = trim($yhtye);
	} 
	
	public function checkYhtye() {
		
		//Tarkistetaan, ettei kenttä ole tyhjä
		if (empty($this->yhtye)) {
			$this->error = 1;
			return "Kenttä ei saa olla tyhjä";
		}
		//Tarkistetaan, ettei ole yli 50 merkkiä
		else if (strlen($this->yhtye) > 50) {
			$this->error = 1;
			return "Enintään 50 merkkiä";
		}
		//Tarkistetaan, että sisältää vain kirjaimia, numeroita
		//välejä, väli- alaviivoja, kysymys- tai huutomerkkejä
		else if (!preg_match('/^[\w\äÄöÖÅå?!\-\s]+$/', $this->yhtye)) {
			$this->error = 1;
			return "Sallittuja vain kirjaimet, numerot ja ?, ! tai - ja _";
		}
	}
	
	public function getNimi() {
		return $this->nimi;
	}
	
	public function setNimi($nimi) {
		$this->nimi = trim($nimi);
	}
	
	public function checkNimi() {
		
		//Tarkistetaan, ettei kenttä ole tyhjä
		if (empty($this->nimi)) {
			$this->error = 1;
			return "Kenttä ei saa olla tyhjä";
		}
		//Tarkistetaan, ettei ole yli 50 merkkiä
		else if (strlen($this->nimi) > 50) {
			$this->error = 1;
			return "Enintään 50 merkkiä";
		}
		
		//Tarkistetaan, että sisältää vain kirjaimia, numeroita
		//välejä, väli- alaviivoja, kysymys- tai huutomerkkejä
		else if (!preg_match('/^[\w\äÄöÖÅå?!\-\s]+$/', $this->nimi)) {
			$this->error = 1;
			return "Sallittuja vain kirjaimet, numerot ja ?, ! tai - ja _";
		}
	}
	
	public function getJulkaisuvuosi() {
		return $this->julkaisuvuosi;
	}
	
	public function setJulkaisuvuosi($julkaisuvuosi) {
		$this->julkaisuvuosi = $julkaisuvuosi;
	}
	
	public function checkJulkaisuvuosi() {
		
		//Tarkistetaan, ettei kenttä ole tyhjä
		if (empty($this->julkaisuvuosi)) {
			$this->error = 1;
			return "Kenttä ei saa olla tyhjä";		
		}
		
		//Tarkistetaan, että koostuu vain neljästä numerosta
		else if (!is_numeric($this->julkaisuvuosi)) {
			$this->error = 1;
			return "Vain numeroita";			
		}
		else if	(strlen($this->julkaisuvuosi) != 4) {
			$this->error = 1;
			return "Kentän pitää koostua tasan neljästä numerosta";
		}
		
		//Tarkistetaan, ettei annettu vuosi ole suurempi kuin tämän
		//hetkinen vuosi
		else if ($this->julkaisuvuosi > date('Y')) {
			$this->error = 1;
			return "Vuosi ei voi olla suurempi kuin nykyinen vuosi";
		}
	}
	
	public function getLevyYhtio() {
		return $this->levyYhtio;
	}
	
	public function setLevyYhtio($levyYhtio) {
		$this->levyYhtio = trim($levyYhtio);		
	}
	
	public function checkLevyYhtio() {
		
		//Tarkistetaan, että ei ole yli 50 merkkiä
		if (strlen($this->levyYhtio) > 50) {
			$this->error = 1;
			return "Enintään 50 merkkiä";
		}
		//Tarkistetaan, että sisältää vain kirjaimia, numeroita
		//välejä, väliviivoja ja alaviivoja
		else if (!empty($this->levyYhtio) && !preg_match('/^[\w\äÄöÖÅå\-\s]+$/', $this->levyYhtio)) {
				$this->error = 1;
				return "Sallittuja vain kirjaimet, numerot _ ja -";
		}		
	}
	
	public function getUrl() {
		return $this->url;
	}
	
	public function setUrl($url) {
		$this->url = trim($url);
	}
	
	public function checkUrl() {
		
		//Tarkistetaan, että kelpo URL, jos kenttä ei ole tyhjä
		if (!filter_var($this->url, FILTER_VALIDATE_URL) && !empty($this->url)) {
			$this->error = 1;
			return "URL ei kelpaa";
		}	
	}
	
	public function getLisatietoja() {
		return $this->lisatietoja;
	}
	
	public function setLisatietoja($lisatietoja) {
		$this->lisatietoja = trim($lisatietoja);
	}
	
	public function checkLisatietoja() {
		
		if (strlen($this->lisatietoja) > 510) {
			$this->error = 1;
			return "Enintään 510 merkkiä";
		}
		//Tarkistetaan, että sisältää vain sallittuja merkkejä, jos ei ole tyhjä
		else if (!empty($this->lisatietoja) &&
				!preg_match('/^[\w\äÄöÖÅå?!\-\s]+$/', $this->lisatietoja)) {
					$this->error = 1;
					return "Sallittuja vain kirjaimet, numerot ja ?, ! tai - ja _";
				}
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function setId($id) {
		$this->id = trim($id);
	}
	
	public function getError() {
		return $this->error;
	}
}