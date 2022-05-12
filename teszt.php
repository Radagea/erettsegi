<?php
/* $to      = 'radagea@gmail.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
*/

//email reset
/*
	include("adatbazis.php");
	$result=mysql_query("SELECT * FROM evszam ORDER BY evho");
	while($row=mysql_fetch_array($result))
	{
		mysql_query("UPDATE evszam SET 
		emeltszintu='Közép szint'
		WHERE id='$row[id]'");
	}
	
?>