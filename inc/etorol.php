<?php
	mysql_query("DELETE FROM evszam WHERE id='$_GET[id]'");
	print("Evszam torolve");
?>