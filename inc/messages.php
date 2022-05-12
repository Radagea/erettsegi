<?php
	mysql_query("UPDATE felhasznalok SET 
	last_login=now()
	WHERE id='$_SESSION[login_id]'");
?>