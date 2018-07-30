<?php 
function active($selected) {

	echo '
	<div class="menu">
		<ul>
			<li id="index" '; 
	if (strstr($selected, "index")) {
		echo "class='active'";
	} 
	echo '><a href="index.php">Etusivu</a></li>
	      	<li id="lisaa" ';
	if (strstr($selected, "lisaa")) {
		echo "class='active'";
	} 
	echo '><a href="lisaaAlbumi.php">Lisää albumi</a></li>
	      	<li id="kaikki" '; 
	if (strstr($selected, "kaikki")) {
		echo "class='active'";
	} 
	echo '><a href="kaikkiAlbumit.php">Albumit</a></li>
			<li id="haeJSON" ';
	if (strstr($selected, "haeJSON")) {
		echo "class='active'";
	}
	echo '><a href="haeJSON.php">Hae albumi (JSON)</a></li>
	      	<li id="asetukset" ';
	if (strstr($selected, "asetukset")) {
		echo "class='active'";
	} 
	echo '><a href="asetukset.php">Asetukset</a></li>                    	
		</ul>
	</div>';
}
?>  