<?php 
	if ($_SESSION[login_jog]==2) {
	if (isset($_POST[gomb]))
	{
		$mit = explode(",","á,é,í,ő,ő,ó,ü,ű,ú");
		$mire = explode(",","a,e,i,o,o,o,u,u,u");
		$evho=$_POST[ev].'_'.$_POST[honap];
		$_FILES[feladatlap][name]=$evho.'.pdf';
		$_FILES[forras][name]=$evho.'_forras.zip';
		$filenev=$_FILES[feladatlap][name];
		$forrasnev=$_FILES[forras][name];

		$filenev = str_replace($mit, $mire, $filenev);
		$forrasnev = str_replace($mit, $mire, $forrasnev);
		
		move_uploaded_file($_FILES[feladatlap][tmp_name],"files/feladatlapok/$filenev");
		
		move_uploaded_file($_FILES[forras][tmp_name],"files/forrasok/$forrasnev");
		
		mysql_query("INSERT INTO evszam VALUES ('','$evho','$_POST[emelt]','$filenev','$forrasnev')");
		print mysql_error();
		print "<h3>Feladatlap felvétele sikeres volt!</h3>";
	}
	else {
	 print 	"
	 <form method=POST action=index.php?op=evszam enctype=multipart/form-data>
	<table>
		<tr>
			<td colspan=2 align=center> <h3>Feladatlap felvétele</h3> </td> 
		</tr>
		<tr>
			<td>Évszám:</td>
			<td><input type=text name=ev></td>
		</tr>
		<tr>
			<td>Hónap</td>
			<td><input type=text name=honap></td>
		</tr>
		<tr>
			<td>Feladatlap szintje: </td>
			<td><select name=emelt>
            <option value='Közép szintű feladatlap'> Közép szintű</option>
            <option value='Emelt szintű feladatlap'> Emelt szintű </option>
          </select></td>
		</tr>
		<tr>
			<td>Feladat lap:</td>
			<td><input type=file name=feladatlap></td><br>
		</tr>
		<tr>
			<td>Forrás fájlok(.rar,.zip kiterjesztés):</td>
			<td><input type=file name=forras></td><br>
		</tr>
		<tr>
			<td colspan=2 align=center><input type=submit name=gomb value='Feladatlap hozzáadása'></td>
		</tr>
	</table>
	</form> <br><br>";
	} 
  $result=mysql_query("SELECT * FROM evszam ORDER BY id");
  print mysql_error();
  
  print "<table border=1>";
  while($row=mysql_fetch_array($result))
  {
    print "
    <tr>
      <td> $row[evho] </td>
	  <td> $row[emeltszintu]</td>
	  <td> <a href=files/feladatlapok/$row[feladatlap] download>Feladatlap letöltése</a> </td>
	  <td> <a href=files/forrasok/$row[forrasfajl] download>Források letöltése</a> </td>
      <td> <a href=index.php?id=$row[id]&op=etorol> Törlés </a></td>
    </tr>";
  } 
  print "</table>";
 } else {
	print "<h1>A keresett oldal nem található!</h1>";
 }
?>