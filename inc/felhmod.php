<?php
	include("adatbazis.php");
	if (isset($_POST[gomb]))
    {
		
		$mit = explode(",","á,é,í,ő,ő,ó,ü,ű,ú");
		$mire = explode(",","a,e,i,o,o,o,u,u,u");
		$nevecske=str_replace($mit,$mire,$_POST[nev]);
		$e=mb_substr($nevecske,0,2,'UTF-8');
		$sz=mb_strpos($nevecske,' ');
		$m=mb_substr($nevecske,$sz+1,2,'UTF-8');
		$azon=$e.$m;
		$azon=mb_strtolower($azon,'UTF-8');


		$azon = str_replace($mit, $mire, $azon);
    
    mysql_query("UPDATE felhasznalok SET 
	nev='$_POST[nev]',
	azon='$azon',
	jelszo='$_POST[jelszo]',
	csopid='$_POST[csoport]',
	email='$_POST[email]',
	jog='$_POST[jog]'
	WHERE id='$_POST[id]'");
    print mysql_error();
	print("A felhasználó módosítva");
	}
  else
  {
	$result=mysql_query("SELECT * FROM felhasznalok WHERE id='$_GET[id]'");
	$nev=mysql_result ($result,0,'nev');
	$email=mysql_result ($result,0,'email'); 
	$jelszo=mysql_result ($result,0,'jelszo');
	$jog=mysql_result ($result,0,'jog');
	$csoport=mysql_result($result,0,'csopid');
    print "
    <form method=POST action=index.php?op=felhmod enctype=multipart/form-data> 
    <table>
      <tr>
        <td colspan=2 align=center> <h3>Felhasználó módosítása</h3> </td> 
      </tr>
      
      <tr>
        <td> Teljes név: </td>
        <td> <input type=text name=nev value='$nev'> </td>
      </tr>
    

      <tr>
        <td> Jelszó: </td>
        <td> <input type=password name=jelszo value='$jelszo'> </td>
      </tr>
      <tr>
        <td> Email: </td>
        <td> <input type=email name=email value='$email'> </td>
      </tr>
	<tr>
        <td> Jog: </td>
        <td>
          <select name=jog>";
			if ($jog==1) {
				print "<option value=1 selected> Diák </option>
					  <option value=2> Tanár </option>";			
			}
			else {
				print "<option value=1> Diák </option>
					   <option value=2 selected> Tanár </option>";
			}
         print "</select>
        </td>
      </tr>
	  <tr>
        <td> Csoport: </td>
        <td> 
          <select name=csoport>
            ";
			$result2=mysql_query("SELECT * FROM csoport ORDER BY id");
			print mysql_error();
			while($row2=mysql_fetch_array($result2))
			{
				print "
				<option value=$row2[id]"; if($row2[id]==$csoport) {print"selected";} print">$row2[neve]</option>
				";
			}
			print "
          </select>
        </td>
      </tr>
      <tr>
        <td colspan=2 align=right>
		<input type=hidden name=id value='$_GET[id]'>
        <input type=submit name=gomb value='Felhasználó módosítása'> </td>
      </tr>
	</form>";
  }
?>