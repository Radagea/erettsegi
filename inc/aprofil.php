<?php
	if ($_SESSION[login_jog]==2)
	{
		$result=mysql_query("SELECT * FROM felhasznalok WHERE id='$_GET[id]'");
		$nev=mysql_result ($result,0,'nev'); 
		$azon=mysql_result ($result,0,'azon'); 
		$csopid=mysql_result($result,0,'csopid');
		$email=mysql_result ($result,0,'email'); 
		$result2=mysql_query("SELECT * FROM csoport WHERE id='$csopid'");
		$csoport=mysql_result($result2,0,'neve');
		$megold=mysql_query("SELECT * FROM megoldasok ORDER BY feladat_id");
		$ffdb=0;
		while($row=mysql_fetch_array($megold))
		{
			if ($_GET[id]==$row[login_id])
			{
				$ffdb++;
			}
		}
		print "
			<table border=0 style='margin-top:30px;'>
				<tr>
					<td align=center> Név: </td>
					<td align=center> $nev </td>
				</tr>
				<tr>
					<td align=center> Azonosító: </td>
					<td align=center> $azon </td>
				</tr>
				<tr>
					<td align=center> Csoport: </td>
					<td align=center> $csoport </td>
				</tr>
				<tr>
					<td align=center> Email: </td>
					<td align=center> $email </td>
				</tr>
				<tr>
					<td align=center> Feltöltött fájlok: </td>
					<td align=center> $ffdb db </td>
				</tr>
			</table>
		";
		print " <h3 style='margin-top: 30px;'>Eddig beküldött feladatai: </h3><br><br>
			<table border=1 style='margin-bottom: 30px;'>
				<td>Megoldás beküldése:</td>
				<td>Feladat típus</td>
				<td>Feladat lap neve</td>
				<td>Szint </td>
				<td>Letöltés</td>";
		$result=mysql_query("SELECT * FROM megoldasok ORDER BY feladat_id");
		while($row=mysql_fetch_array($result))
		{
			if ($_GET[id]==$row[login_id])
			{	
				$fresult=mysql_query("SELECT * FROM feladat ORDER BY hatarido DESC");
				while ($frow=mysql_fetch_array($fresult)){
					if ($row[feladat_id]==$frow[id]){
						print "	<tr>
						<td> $row[megoldas] </td>
						<td>";
							$result1=mysql_query("SELECT * FROM feladat_tipus WHERE id='$frow[feladattipusa]'");
							$feladattipus=mysql_result ($result1,0,'megnev');
						print" $feladattipus
						</td>
						<td>";
							$result2=mysql_query("SELECT * FROM evszam WHERE id='$frow[feladatlap]'");
							$feladatlap=mysql_result ($result2,0,'feladatlap');
							$emelt=mysql_result ($result2,0,'emeltszintu');
						print " $feladatlap
						</td>
						<td>$emelt</td>
						<td><a href=files/megoldasok/$row[fajlnev] download>Klikk</a></td>
					</tr>";
					}
				}
			}
		}

	}
	else {
		print "A keresett oldal nem található!";
	}
?>