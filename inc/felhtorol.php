<?php
	include("adatbazis.php");
	mysql_query("DELETE FROM felhasznalok WHERE id='$_GET[id]'");
	print ("A felhasználó törölve");
?>