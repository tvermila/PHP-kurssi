<?php 
//albumi-luokka mukaan
require_once 'albumi.php';

//aloitetaan sessio
session_start();

//otetaan kyytiin istuntoon tallennettu olio
$etsiAlbumi = $_SESSION['$etsiAlbumi'];

if (isset($_POST['takaisin'])) {
	header("Location: kaikkiAlbumit.php");
	exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<link href="Styles/main.css" type="text/css" rel="stylesheet"/>
<link href="Styles/etsiNayta.css" type="text/css" rel="stylesheet"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>Albumit</title>
</head>
<body>
<?php include 'menu.php'; 
active("kaikki");
?>


<div id="etsiNayta">
<?php 
print("Yhtye: <span class='nayttospani'>".$etsiAlbumi->getYhtye() . "</span><br/>\n");
print("Albumi: <span class='nayttospani'>".$etsiAlbumi->getNimi() . "</span><br/>\n");
print("Julkaisuvuosi: <span class='nayttospani'>".$etsiAlbumi->getJulkaisuvuosi() . "</span><br/>\n");
print("Levy-yhtiö: <span class='nayttospani'>".$etsiAlbumi->getLevyYhtio() . "</span><br/>\n");
print("URL: <span class='nayttospani'>\n<a href='".$etsiAlbumi->getUrl(). "' target='_blank'>".
		$etsiAlbumi->getUrl()."</a></span><br/>\n");
print("Lisätietoja: <span class='nayttospani'>".$etsiAlbumi->getLisatietoja() . "</span><br/>\n");
?>
</div>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
<input type="submit" name="takaisin" value="Takaisin">
</form>


<?php include 'bottomElements.php';?>
</body>
</html>