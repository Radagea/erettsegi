<?php
	mysql_query("DELETE FROM feladat WHERE id='$_GET[id]'");
	print("Feladat torolve");
?>