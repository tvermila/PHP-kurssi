<?php 
//albumi-luokka mukaan
require 'albumi.php';
require_once 'albumiPDO.php';

//aloitetaan sessio
session_start();

if (isset($_SESSION['$albumi']) != null) {
	//otetaan kyytiin istuntoon tallennettu olio
	$albumi = $_SESSION['$albumi'];
}
else {
	$albumi = new Albumi();
}
?>
<!DOCTYPE html>
<html>
<head>
<link href="Styles/main.css" type="text/css" rel="stylesheet"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>Etusivu</title>
</head>
<body>
<?php include 'menu.php';
active("nayttosivu");
?>

	<h2>Annoit seuraavat tiedot</h2>
	
	<p>
		<label class="naytto">Yhtye:&nbsp;</label>
		<span class="nayttospani"><?php echo $albumi->getYhtye()?></span>
	</p>
	
	<p>
	<label class="naytto">Albumin nimi:&nbsp;</label>
	<span class="nayttospani"><?php echo $albumi->getNimi()?></span>
	</p>
	
	<p>
	<label class="naytto">Julkaisuvuosi:&nbsp;</label>
	<span class="nayttospani"><?php echo $albumi->getJulkaisuvuosi()?></span>
	</p>
	
	<p>
	<label class="naytto">Levy-yhtiö:&nbsp;</label>
	<span class="nayttospani"><?php echo $albumi->getLevyYhtio()?></span>
	</p>
	
	<p>
	<label class="naytto">URL:&nbsp;</label>
	<span class="nayttospani">
	<a href="<?php echo $albumi->getUrl()?>" target="_blank">
	<?php echo $albumi->getUrl()?></a></span>
	</p>
	
	<p>
	<label class="naytto">Lisätietoja:&nbsp;</label>
	<span class="nayttospani"><?php echo $albumi->getLisatietoja()?></span>
	</p>
	
	<!-- Submit-painikkeet -->
   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <input name="tallenna" type="submit" id="button" value="Tallenna"/>
    <input name="korjaa" type="submit" id="reset" value="Korjaa"/>
    <input name="peruuta" type="submit" id="peruuta" value="Peruuta" />
    </form>

<?php 
    //jos tallenna-painiketta painetaan
if (isset($_POST['tallenna'])) {
	$kantakasittely = new albumiPDO();
	$kantakasittely->lisaaAlbumi($albumi);
	unset($_SESSION['$albumi']);
	header("Location: tiedotTallennettu.php");
	exit;
}

//jos korjaa-painiketta painetaan
if (isset($_POST['korjaa'])) {	
	header("Location: lisaaAlbumi.php");
	exit;
	}

//Jos peruuta-nappia painetaan, poistetaan istuntomuuttuja/olio j
//a siirrytään etusivulle
if (isset($_POST['peruuta'])) {
	unset($_SESSION['$albumi']);
	header("Location: index.php");
	exit;
	}
?>

<?php include 'bottomElements.php';?>
</body>
</html>