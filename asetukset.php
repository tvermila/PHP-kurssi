<?php 
//Tarkistetaan onko cookiessa jo nimi, jos on, se asetetaan nimi-muuttujaan
if (isset($_COOKIE["nimi"])) {
	$nimi = $_COOKIE["nimi"];
}
else {
	$nimi = "";
}

//Jos painetaan muuta-nappia
if (isset($_POST['muuta'])) {
	setcookie("nimi", $_POST['nimi'], time()+60*60*24*7);
	header ("location: index.php");
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<link href="Styles/main.css" type="text/css" rel="stylesheet"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>Asetukset</title>
</head>
<body>
<?php include 'menu.php'; 
active("asetukset");
?>

	<h1>Asetukset</h1>
	
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	<label>Nimesi:</label>
	<input name="nimi" type="text" size="25" value="<?php echo $nimi;?>">
	<input name="muuta" type="submit" id="button" value="Muuta nimeä">	
	</form>

<?php include 'bottomElements.php';?>
</body>
</html>