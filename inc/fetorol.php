<?php
	mysql_query("DELETE FROM feladat_tipus WHERE id='$_GET[id]'");
	print "A feladat típus sikeresen törölve lett!";
?>