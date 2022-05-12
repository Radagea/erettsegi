<?php 
	if ($_SESSION[login_jog]==2) 
  {
	  if (isset($_POST[gomb]))
	  {
		//$mit = explode(",","á,é,í,ő,ő,ó,ü,ű,ú");
		//$mire = explode(",","a,e,i,o,o,o,u,u,u");
		//$_FILES[fajl][name]=$_POST[cim];
		$filenev=$_FILES[fajl][name];

		$filenev = str_replace($mit, $mire, $filenev);
		
		move_uploaded_file($_FILES[fajl][tmp_name],"files/tetelek/$filenev");
		
		
		mysql_query("INSERT INTO tetelek VALUES ('','$_POST[cim]','$_POST[megjegy]','$filenev')");
		print mysql_error();
		print "<h3>Tétel hozzáadása sikeres volt!</h3>";
	  }
	  else 
    {
	 print 	"
	 <form method=POST action=index.php?op=teteladd enctype=multipart/form-data>
	<table>
		<tr>
			<td colspan=2 align=center> <h3>Tétel feltöltése</h3> </td> 
		</tr>
		<tr>
			<td>Tétel címe:</td>
			<td><input type=text name=cim></td>
		</tr>
		<tr>
			<td>Megjegyzés a tételhez: </td>
			<td><input type=text name=megjegy></td>
		</tr>
		<tr>
			<td>Tétel feltöltése:</td>
			<td><input type=file name=fajl></td><br>
		</tr>
		<tr>
			<td colspan=2 align=center><input type=submit name=gomb value='Tétel hozzáadása'></td>
		</tr>
	</table>
	</form> <br><br>";
	} 
  $result=mysql_query("SELECT * FROM tetelek ORDER BY id");
  print mysql_error();
  
  print "<table border=1>";
  while($row=mysql_fetch_array($result))
  {
    print "
    <tr>
      <td> $row[cim] </td>
	  <td> $row[megjegy]</td>
	  <td> <a href=files/tetelek/$row[filenev] download>Tétel letöltése</a> </td>
      <td> <a href=index.php?id=$row[id]&op=teteltorl> Törlés </a></td>
    </tr>";
  } 
  print "</table>";
 } else {
	print "<h1>A keresett oldal nem található!</h1>";
 }
?>