<?php
try { 
	require_once "albumiPDO.php";
	
	// Luodaan tietokanta-luokan olio
	$kantakasittely = new albumiPDO();

	// Jos sivua pyytäneelta tuli hakusana 
	if (isset ($_GET["hakusana"])) {

		// Tehdään kantahaku
		$tulos = $kantakasittely->haeAlbumit($_GET["hakusana"]);
		
		// Palautetaan vastaus JSON-tekstina
		print(json_encode($tulos));
	} 	
	
	// Kyseessa on kaikkien albumien haku kannasta
	else {	
		$tulos = $kantakasittely->kaikkiAlbumit();
	
		// Palautetaan vastaus JSON-tekstinä
		print(json_encode($tulos));
	}
} catch (Exception $error) {
}
?>
