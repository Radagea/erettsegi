<?php 
	if ($_SESSION[login_jog]==2) {
	if (isset($_POST[gomb]))
	{
		mysql_query("INSERT INTO feladat_tipus VALUES ('','$_POST[feladat]')");
		print mysql_error();
	}
	else {
	 print 	"
	 <form method=POST action=index.php?op=feladat_type>
	<table>
		<tr>
			<td colspan=2 align=center> <h3>Feladat típus megadása</h3> </td> 
		</tr>
		<tr>
			<td>Feladat típusa:</td>
			<td><input type=text name=feladat></td>
		</tr>
		<tr>
			<td colspan=2 align=center><input type=submit name=gomb value='Feladat hozzáadása'></td>
		</tr>
	</table>
	</form>";
	}
  $result=mysql_query("SELECT * FROM feladat_tipus ORDER BY id");
  print mysql_error();
  
  print "<table border=1>";
  while($row=mysql_fetch_array($result))
  {
    print "
    <tr>
      <td> $row[megnev] </td>
	  <td> <a href=index.php?id=$row[id]&op=femod> Módosítás </a></td>
      <td> <a href=index.php?id=$row[id]&op=fetorol> Törlés </a></td>
    </tr>";
  } 
  print "</table>";
	} else
	{ print "A keresett oldal nem található!";}
?>