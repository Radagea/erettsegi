<?php
	if (isset($_SESSION[login_id]))
	{
		if (isset($_POST[gomb])) {
			if ($_SESSION[login_jelszo]==$_POST[regijelszo]){
				if ($_POST[ujjelszo]==$_POST[ujjelszo2]) {
				mysql_query("UPDATE felhasznalok SET 
				jelszo='$_POST[ujjelszo]'
				WHERE id='$_SESSION[login_id]'");	
				print "A jelszó csere megtörtént, mostmár betudsz jelentkezni az új jelszavaddal!";
				} else
				{
					print "A két megadott jelszó nem egyezik!";
				}
			} else 
			{
				print "A régi jelszó nem jó!";
			}
		}else {
			print"
				<form method=POST action=index.php?op=jelszocsere enctype=multipart/form-data> 
				<table>
					<tr>
						 <td colspan=2 align=center> <h3>Jelszó módosítása</h3> </td> 
					</tr>
					<tr>
						<td>Régi jelszó</td>
						<td><input type=password name=regijelszo></td>
					</tr>
					<tr>
						<td>Új jelszó</td>
						<td><input type=password name=ujjelszo></td>
					</tr>
					<tr>
						<td>Új jelszó mégegyszer</td>
						<td><input type=password name=ujjelszo2></td>
					</tr>
					<tr>
						<td colspan=2 align=center><input type=submit name=gomb value='Jelszó módosítása'></td>
					</tr>
				</table>
			";
		}
	}
?>