<?php
	if (isset($_SESSION[login_id]))
	{
		if (isset($_POST[gomb])) {
			if ($_POST[email]=="")
			{ print "Nem hagyhatod üresen az email mezőt!";}
			else {
				mysql_query("UPDATE felhasznalok SET 
				email='$_POST[email]',
				evaltoztatott='1'
				WHERE id='$_SESSION[login_id]'");	
				print "Az email cím csere megtörtént!";
			}
		}else {
			$result=mysql_query("SELECT * FROM felhasznalok WHERE id='$_SESSION[login_id]'");
			$email=mysql_result ($result,0,'email'); 
			print"
				<form method=POST action=index.php?op=emailcsere enctype=multipart/form-data> 
				<table>
					<tr>
						 <td colspan=2 align=center> <h3>Email módosítása</h3> </td> 
					</tr>
					<tr>
						<td>E-mail cím:</td>
						<td><input type=email name=email placeholder=$email></td>
					</tr>
						<td colspan=2 align=center><input type=submit name=gomb value='Email módosítása'></td>
					</tr>
				</table>
			";
		}
	}
?>