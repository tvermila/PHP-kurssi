<?php 
require_once 'albumi.php';

//Aloitetaan istunto
session_start();

//Kun painetaan tallenna-nappia
if (isset($_POST['tallenna'])) {
	$albumi = new Albumi($_POST['yhtye'], 
			$_POST['nimi'],
			$_POST['julkaisuvuosi'],
			$_POST['levyYhtio'],
			$_POST['url'],
			$_POST['lisatietoja']);
	
	//tallennetaan olio istuntoon
	$_SESSION['$albumi'] = $albumi;


	$yhtyeVirhe = $albumi->checkYhtye();
	$nimiVirhe = $albumi->checkNimi();
	$julkaisuvuosiVirhe = $albumi->checkJulkaisuvuosi();
	$levyYhtioVirhe = $albumi->checkLevyYhtio();
	$urlVirhe = $albumi->checkUrl();
	$lisatietojaVirhe = $albumi->checkLisatietoja();
	
	if ($albumi->getError() == 0) {
		header('Location: nayttosivu.php');	
		exit;
	}
}
//Kun painetaan peruuta-nappia, poistetaan istuntomuuttuja ja palataan etusivulle
else if (isset($_POST['peruuta'])) {
	unset($_SESSION['$albumi']);
	header ("location: index.php");
	exit;
}
//Kun painetaan tyhjennä-nappia, poistetaan istuntomuuttuja ja luodaan tyhjä olio tilalle
else if (isset($_POST['tyhjenna'])) {
	unset($_SESSION['$albumi']);
	$albumi = new Albumi();
	$yhtyeVirhe = "";
	$nimiVirhe = "";
	$julkaisuvuosiVirhe = "";
	$levyYhtioVirhe = "";
	$urlVirhe = "";
	$lisatietojaVirhe = "";
}
//Jos istuntomuuttuja on olemassa, otetaan sen tiedot albumi-muuttujaan
else if (isset($_SESSION['$albumi'])) {
	//otetaan kyytiin istuntoon tallennettu olio
	$albumi = $_SESSION['$albumi'];
	
	$yhtyeVirhe = $albumi->checkYhtye();
	$nimiVirhe = $albumi->checkNimi();
	$julkaisuvuosiVirhe = $albumi->checkJulkaisuvuosi();
	$levyYhtioVirhe = $albumi->checkLevyYhtio();
	$urlVirhe = $albumi->checkUrl();
	$lisatietojaVirhe = $albumi->checkLisatietoja();
}
else {
	$albumi = new Albumi();
	$yhtyeVirhe = "";
	$nimiVirhe = "";
	$julkaisuvuosiVirhe = "";
	$levyYhtioVirhe = "";
	$urlVirhe = "";
	$lisatietojaVirhe = "";
}

?>

<!DOCTYPE html>
<html>
<head>
  <link href="Styles/main.css" type="text/css" rel="stylesheet"/>
  <link href="Styles/lisaaAlbumi.css" type="text/css" rel="stylesheet"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <title>Lisää albumi</title>
</head>
<body>
<?php include 'menu.php'; 
active("lisaa");
?>

  <form id="lomake" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

    <!-- Yhtye (text) -->
    <p>
      <label class="lomake">Yhtye:</label>
      <input type="text" name="yhtye" id="yhtye" size="50" value="<?php echo $albumi->getYhtye();?>"  />
      <span class="virhe" style="color:red;"><?php echo $yhtyeVirhe; ?></span>	
    </p>

    <!--  Albumin nimi (text) -->
    <p>
      <label class="lomake">Albumin nimi:</label>
      <input type="text" name="nimi" size="50" value="<?php echo htmlentities($albumi->getNimi());?>" />
      <span class="virhe" style="color:red;"><?php echo $nimiVirhe; ?></span>
    </p>

    <!-- Julkaisuvuosi (text) (Validation: no blank – 1900 – 2017) -->
    <p>
      <label class="lomake">Julkaisuvuosi:</label>
      <input type="text" name="julkaisuvuosi" size="5" id="julkaisuvuosi" 
      value="<?php echo htmlentities($albumi->getJulkaisuvuosi());?>" />
 	  <span class="virhe" style="color:red;"><?php echo $julkaisuvuosiVirhe; ?></span>	
    </p>
    
    <!-- Levy-yhtiö (text) -->
    <p>
    <label class="lomake">Levy-yhtiö:</label>
    <input type="text" name="levyYhtio" size="50" value="<?php echo htmlentities($albumi->getLevyYhtio());?>" />
    <span class="virhe" style="color:red;"><?php echo $levyYhtioVirhe; ?></span>
    </p>

    <!-- URL levyyn (text) -->
    <p>
      <label class="lomake">URL:</label>
      <input type="text" name="url" size="50" value="<?php echo htmlentities($albumi->getUrl());?>" />
      <span class="virhe" style="color:red;"><?php echo $urlVirhe; ?></span>
    </p>

    <!-- Lisätietoja (textarea) -->
    <p>
      <label class="lomake">Lisätietoja:</label>
      <textarea name="lisatietoja" cols="40" rows="8" placeholder="Lisätietoja..." 
      id="lisatietoja"><?php echo htmlentities($albumi->getLisatietoja());?></textarea><br/>
      <span class="virhe2"><?php echo $lisatietojaVirhe; ?></span>
    </p>

    <!-- Submit- ja reset-painikkeet -->
    <input name="tallenna" type="submit" class="button" value="Tallenna" />
    <input name="tyhjenna" type="submit" class="button" value="Tyhjennä" />
    <input name="peruuta" type="submit" class="button" value="Peruuta" />

  </form>
  
<?php include 'bottomElements.php';?>
</body>
</html>
