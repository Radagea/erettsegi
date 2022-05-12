<?php 
	if ($_SESSION[login_jog]==2) {
	if (isset($_POST[gomb]))
	{
		mysql_query("INSERT INTO csoport VALUES ('','$_POST[csoport]')");
		print mysql_error();
	}
	else {
	 print 	"
	 <form method=POST action=index.php?op=csoport>
	<table>
		<tr>
			<td colspan=2 align=center> <h3>Csoport hozzáadása</h3> </td> 
		</tr>
		<tr>
			<td>Csoport neve:</td>
			<td><input type=text name=csoport></td>
		</tr>
		<tr>
			<td colspan=2 align=center><input type=submit name=gomb value='Csoport hozzáadása'></td>
		</tr>
	</table>
	</form>";
	}
    $result=mysql_query("SELECT * FROM csoport ORDER BY id");
    print mysql_error();
  
    print "<table border=1>";
    while($row=mysql_fetch_array($result))
    {
    print "
    <tr>
      <td> $row[neve] </td>
      <td> <a href=index.php?id=$row[id]&op=csoptorol> Törlés </a></td>
    </tr>";
   } 
	print "</table> <br><br><br><br>";
	print "<table border=1>
	<tr>
		<td colspan=2> Felhasználók csoportokban: </td>
	</tr>";
	$result=mysql_query("SELECT * FROM csoport ORDER BY id");
    while($row=mysql_fetch_array($result))
    {
		print "
		<tr>
		  <td colspan=2> Csoport $row[neve]: </td>
		</tr>";
		$csoport=mysql_query("SELECT * FROM felhasznalok ORDER BY nev");
		while($csoprow=mysql_fetch_array($csoport))
		{
			if ($csoprow[csopid]==$row[id])
			{
				print "
					<tr>
						<td> </td>
						<td><a style='color: #7D7D7D;' href=index.php?op=aprofil&id=$csoprow[id]>$csoprow[nev]</a></td>
					</tr>
				";
			}
		}
	} 
	print "</table> <br><br><br><br>";
	} else
	{ print "A keresett oldal nem található!";}
?>