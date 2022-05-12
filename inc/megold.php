<?php
	if ($_SESSION[login_jog]==1)
	{
		$osda=mysql_query("SELECT * FROM felhasznalok WHERE id='$_SESSION[login_id]'");
		$eval=mysql_result ($osda,0,'evaltoztatott');
		if ($eval==1)
		{
			if (isset($_POST[gomb]))
			{
				$filenev=$_FILES[megoldfile][name];
				if ($filenev=="")
				{
					print "HIBA! Nem töltöttél fel fájlt kérlek próbáld újra. :)";
				}
				else {
					$filenev=$_SESSION[login_azon].$_FILES[megoldfile][name];
					move_uploaded_file($_FILES[megoldfile][tmp_name],"files/megoldasok/$filenev");
					mysql_query("INSERT INTO megoldasok VALUES ('','$_SESSION[login_id]','$_POST[feladatid]','$filenev',now(),'$_POST[megjegy]')");
					print mysql_error();
					print "Megoldás sikeresen beküldve!";
				}
			}else {
				print "
				<center>
				<form method=POST action=index.php?op=megold enctype=multipart/form-data>
						<tr>
							<td colspan=2 align=center><h3 style='margin-bottom :30px;'>Megoldás beküldése: </h3></td>
						</tr>
						<tr>
							<td align=center>Fájl:</td>
							<td align= center><input type=file name=megoldfile></td>
						</tr><br>
						<tr>
							<td>Megjegyzés:</td>
							<td><input type=text name=megjegy></td>
						</tr><br>
						<tr>
							<td colspan=2 align=center><input type=submit name=gomb></td>
						</tr>
						<input type=hidden name=feladatid value=$_GET[id]>
				</form>
				</center>
				";
			}
		}else {
			print "<a href=index.php?op=emailcsere style='color:red;'>Ahhoz, hogy feltölts egy megoldást megkell változtatnod az e-mailed itt.</a>";
		}
	}
	else {
		print "Az oldal nem található!";
	}
?>