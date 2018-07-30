<!DOCTYPE html>
<html>
<head>
<link href="Styles/main.css" type="text/css" rel="stylesheet"/>
<script
	src="http://code.jquery.com/jquery-2.2.4.min.js"
	integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
	crossorigin="anonymous">
</script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>Hae albumi (JSON)</title>
</head>
<body>
<?php include 'menu.php'; 
active("haeJSON");
?>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	<label>Albumin nimi:</label>
	<input name="hakusana" type="text" id="hakusana" size="35">
	<input name="hae" type="button" id="hae" value="Hae">	
	</form>
	
	<div id="lista"></div>

<?php include 'bottomElements.php';?>

<script type="text/javascript">

		$(document).on("ready", function() {
		  $("#hae").on("click", function() {
			$.ajax({
                url: "albumitJSON.php",  // PHP-sivu, jota haetaan AJAX:lla
                method: "get",
                data: {hakusana: $("#hakusana").val()},
				dataType: "json",
                timeout: 5000
            }) //ajax
			.done(function(data) {
				// Tyhjennetään elementti, johon vastaus laitetaan (id="lista")
				$("#lista").html("");

				// Käsitellään taulukko, 
				for(var i = 0; i < data.length; i++) {
					// Lisätään id="lista" elementtiin sisältää
					$("#lista").append("<p>Yhtye: " + data[i].yhtye +
					"<br>Albumin nimi: " + data[i].nimi +
					"<br>Julkaisuvuosi: " + data[i].julkaisuvuosi +
					"<br>Levy-yhtiö: " + data[i].levyYhtio +
					"<br>URL: " + data[i].url + 
					"<br>Lisätietoja: " + data[i].lisatietoja + "</p>");
				} //for
				// Jos vastauksena ei tullut yhtään riviä eli vastaus oli tyhjä taulukko
				if (data.length == 0) {
					$("#lista").append("<p>Haku ei tuottanut yhtään albumia</p>")
				} //if
            }) //done
			.fail(function() {
 			    $("#lista").html("<p>Listausta ei voida tehdä</p>");
			}); //fail
		  }); // click
		}); //ready
	</script>
</body>
</html>