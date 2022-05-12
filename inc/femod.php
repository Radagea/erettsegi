<?php
	if (isset($_POST[gomb]))
    {
    mysql_query("UPDATE feladat_tipus SET 
	megnev='$_POST[feladat]'
	WHERE id='$_POST[id]'");
    print mysql_error();
	print("Feladat típus módosítva!");
	}
  else
  {
	$result=mysql_query("SELECT * FROM feladat_tipus WHERE id='$_GET[id]'");
	$fmegn=mysql_result ($result,0,'megnev');
	 print 	"
	 <form method=POST action=index.php?op=femod>
	<table>
		<tr>
			<td colspan=2 align=center> <h3>Típus módosítása</h3> </td> 
		</tr>
		<tr>
			<td>Feladat tipus::</td>
			<td><input type=text name=feladat value=$fmegn></td>
		</tr>
		<tr>
			<td colspan=2 align=center>
			<input type=hidden name=id value='$_GET[id]'>
			<input type=submit name=gomb value='Feladat típus megváltoztatása'></td>
		</tr>
	</table>
	</form>";
	} 
?>