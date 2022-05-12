<meta charset="UTF-8">
<?php
	if ($_SESSION[login_jog]==2) {
	header ('Content-type: text/html; charset=utf-8');
	include("adatbazis.php");
	 if (isset($_POST[gomb])) { 
		$e=mb_substr($_POST[nev],0,2,'UTF-8');
		$sz=mb_strpos($_POST[nev],' ');
		$m=mb_substr($_POST[nev],$sz+1,2,'UTF-8');
		$azon=$e.$m;
		$azon=mb_strtolower($azon,'UTF-8');

		$mit = explode(",","á,é,í,ő,ő,ó,ü,ű,ú");

		$mire = explode(",","a,e,i,o,o,o,u,u,u");

		$azon = str_replace($mit, $mire, $azon);
		
		print "$azon";
		mysql_query("INSERT INTO felhasznalok VALUES ('','$_POST[nev]','$azon', '$_POST[jelszo]','$_POST[csoport]','$_POST[email]','','$_POST[jog]','')");
		print mysql_error();
	}
	else {
	print "
    <form method=POST action=index.php?op=felh_felvetel enctype=multipart/form-data>
    <table>
      <tr>
        <td colspan=2 align=center> <h3>felhasználó felvétele</h3> </td> 
      </tr>
      
      <tr>
        <td> Teljes név: </td>
        <td> <input type=text name=nev> </td>
      </tr>
      
      <tr>
        <td> Jelszó: </td>
        <td> <input type=password name=jelszo> </td>
      </tr>

      <tr>
        <td> Email: </td>
        <td> <input type=text name=email> </td>
      </tr>
      <tr>
        <td> Jog: </td>
        <td> 
          <select name=jog>
            <option value=1> Diák </option>
            <option value=2> Tanár </option>
          </select>
        </td>
      </tr>
	  <tr>
        <td> Csoport: </td>
        <td> 
          <select name=csoport>
            ";
			$result=mysql_query("SELECT * FROM csoport ORDER BY id");
			print mysql_error();
			while($row=mysql_fetch_array($result))
			{
				print "
				<option value=$row[id]>$row[neve]</option>
				";
			}
			print "
          </select>
        </td>
      </tr>
      <tr>
        <td colspan=2 align=center> 
        <input type=submit name=gomb value='Felhasználó felvétel'> </td>
      </tr>
	  </table>
	  </form>
	  ";
	}
  $result=mysql_query("SELECT * FROM felhasznalok ORDER BY nev");
  print mysql_error();
  
  print "<table border=1>
  <tr>
      <td> Név </td>
      <td> Jog </td>
	  <td> Email </td>
	  <td> </td>
      <td></td>
    </tr>
  
  ";
  while($row=mysql_fetch_array($result))
  {
    print "
    <tr>
      <td> $row[nev] </td>
      <td> $row[jog] </td>
	  <td> $row[email] </td>
	  <td> <a href=index.php?id=$row[id]&op=felhmod> Módosítás </a></td>
      <td> <a href=index.php?id=$row[id]&op=felhtorol> Törlés </a></td>
    </tr>";
  } 
  print "</table>";
	} else {print "A keresett oldal nem található!";}
?>