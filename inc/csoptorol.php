<?php
	mysql_query("DELETE FROM csoport WHERE id='$_GET[id]'");
	print "A csoport sikeresen törölve lett!";
?>