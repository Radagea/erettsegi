<?php
	$result=mysql_query("SELECT * FROM felhasznalok WHERE azon='$_POST[azon]' and jelszo='$_POST[jelszo]'");
	if (mysql_num_rows($result)>0)
	{
		$_SESSION[login_id]=mysql_result($result,0,'id');
		$_SESSION[login_nev]=mysql_result($result,0,'nev');
		$_SESSION[login_email]=mysql_result($result,0,'email');
		$_SESSION[login_azon]=mysql_result($result,0,'azon');
		$_SESSION[login_jog]=mysql_result($result,0,'jog');
		$_SESSION[login_jelszo]=mysql_result($result,0,'jelszo');
/*		mysql_query("UPDATE felhasznalok SET 
		last_login=now()
		WHERE id='$_SESSION[login_id]'"); */
		header('Location: index.php');
	}
	else 
	{
		print "Felhasználó és/vagy jelszó nem jó!";
	}
?>