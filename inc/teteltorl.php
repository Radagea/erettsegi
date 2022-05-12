<?php
	mysql_query("DELETE FROM tetelek WHERE id='$_GET[id]'");
	print("Tétel törölve!");
?>