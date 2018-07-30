<?php 
include "albumiPDO.php";
//Tarkistetaan onko painettu näytä-nappia
if (isset($_POST['nayta'])) {
	//Aloitetaan istunto
	session_start();
	$kantakasittely = new albumiPDO();
	$etsiAlbumi = $kantakasittely->etsiAlbumi($_POST['id']);
	$_SESSION['$etsiAlbumi'] = $etsiAlbumi;
	header ("location: etsiNayta.php");
	exit;
}
else if (isset($_POST['poista'])) {
	$kantakasittely = new albumiPDO();
	$kantakasittely->poistaAlbumi($_POST['id']);
	header ("location: kaikkiAlbumit.php");
	exit;
}
else {
	$etsiAlbumi = new Albumi();
}
?>
<!DOCTYPE html>
<html>
<head>
<link href="Styles/main.css" type="text/css" rel="stylesheet"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>Albumit</title>
</head>
<body>
<?php include 'menu.php'; 
active("kaikki");
?>
 
	<h1>Listataan kaikki albumit</h1>
	
<table id="listaus">
<?php 
try {
$kantakasittely = new albumiPDO();
$rivit = $kantakasittely->kaikkiAlbumit();
$lkm = 1; //tehdään laskuri järjestysnumeroita varten

foreach ($rivit as $albumi) {
	echo "<tr>\n";
	print("  <td>".$lkm . ".</td>\n");
	print("  <td>".$albumi->getYhtye() . "</td>\n");
	print("  <td>".$albumi->getNimi() . "</td>\n");
	print( 
	"  <td>
	<form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
	  <input type='hidden' name='id' value='".$albumi->getId()."'>
	  <input type='submit' name='nayta' value='Näytä'>
	  <input type='submit' name='poista' value='Poista'>
	</form>
  </td>\n"); 
	echo "</tr>\n";
	$lkm++;
}
} catch (Exception $error) {
	print($error->getMessage());
}
?>
</table>

<?php include 'bottomElements.php';?>
</body>
</html>