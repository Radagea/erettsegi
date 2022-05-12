<?php
  print "<h2>Inforrmatika szóbeli tételek</h2><br><br>";
  $result=mysql_query("SELECT * FROM tetelek ORDER BY id");
  print mysql_error();
  $szam=1;
  print "<table border=1>
  <tr>
	<td></td>
	<td>Tétel címe</td>
	<td>Tételhez fűzött megjegyzés: </td>
	<td> Tétel letöltése: </td>
  </tr>";
  while($row=mysql_fetch_array($result))
  {
    print "
    <tr>
	  <td>$szam</td>
      <td> $row[cim] </td>
	  <td> $row[megjegy]</td>
	  <td> <a href=files/tetelek/$row[filenev] download>Tétel letöltése</a> </td>
    </tr>";
	$szam++;
  } 
  print "</table>";
?>