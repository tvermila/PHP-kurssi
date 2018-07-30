<?php 
//Tarkistetaan onko cookiessa jo nimi, jos on, se asetetaan nimi-muuttujaan
if (isset($_COOKIE["nimi"])) {
	$nimi = ", ".$_COOKIE["nimi"];
}
else {
	$nimi = "";
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
active("index");
?>
   
  <h1>Tervetuloa<?php echo $nimi;?>!</h1>
  
   <p>
	  Tämä sivusto on tehty PHP-kurssin harjoitustyönä.
	  Sivustolla on mahdollista lisätä levyjä tietokantaan. Lisäys-lomakkeessa on toteutettu validointi.
	  Lisäksi voi hakea levyjen tiedot ja poistaa levyjä kannasta. Asetuksien kautta määriteltävän käyttäjän
	  on tarkoitus demota keksien (cookies) toimintaa. Kun laitat sinne nimen, se näkyy etusivulla tervehdyksen perässä.
	  Sivuston tekoon ei ole käytetty mitään CSS frameworkia, kuten Bootstrapia. 
  </p>

<?php include 'bottomElements.php';?>
</body>
</html>
