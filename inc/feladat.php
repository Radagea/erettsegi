<?php
	if ($_SESSION[login_jog]==2) {
	if (isset($_POST[gomb])) {
		
		mysql_query("INSERT INTO feladat VALUES ('',now(),'$_POST[datum]', '$_POST[ido]', '$_POST[f_tipus]','$_POST[feladatlap]')");
		print mysql_error();
		print "A felvétel sikerült";
		header("Location: index.php?op=feladat");
	} else 
	{
		print "
			<form method=POST action=index.php?op=feladat enctype=multipart/form-data>
				<table>
					<tr>
						<td colspan=2 align=center> <h3>Feladat felvétele</h3> </td> 
					</tr>     
					<tr>
						<td> Határidő (Dátum): </td>
						<td> <input type=date name=datum> </td>
					</tr>
					<tr>
						<td> Idő (óra,perc): </td>
						<td> <input type=time name=ido> </td>
					</tr>
					<tr>
						<td> Feladat típus: </td>
						<td> 
							<select name=f_tipus>";
							$result=mysql_query("SELECT * FROM feladat_tipus ORDER BY megnev");
							while($row=mysql_fetch_array($result))
							{
								print"<option value=$row[id]>$row[megnev]</option>";
							}
					print"
							</select>
						</td>
					</tr>
					<tr>
						<td> Feladatlap: </td>
						<td> 
							<select name=feladatlap>";
							$result=mysql_query("SELECT * FROM evszam ORDER BY evho");
							while($row=mysql_fetch_array($result))
							{
								print"<option value=$row[id]>$row[evho] || $row[emeltszintu]</option>";
							}
					print"
							</select>
						</td>
					</tr>
					<tr>
						<td colspan=2 align=center> 
							<input type=submit name=gomb value='Feladat felvétele'> </td>
					</tr>
				</table>
			</form> <br><br>
		";
		print "<table border=1>
			<td>Felvételi idő</td>
			<td>Dátum</td>
			<td>Idő</td>
			<td>Feladat típus</td>
			<td>Feladat lap </td>
			<td>Szint </td>
			<td></td>
			<td></td>";
		$result=mysql_query("SELECT * FROM feladat ORDER BY felveteliido");
		print mysql_error();
		while($row=mysql_fetch_array($result))
		{
			print "
			<tr>
				<td> $row[felveteliido] </td>
				<td> $row[hatarido] </td>
				<td> $row[ido] </td>
				<td>";
					$result1=mysql_query("SELECT * FROM feladat_tipus WHERE id='$row[feladattipusa]'");
					$feladattipus=mysql_result ($result1,0,'megnev');
				print" $feladattipus
				</td>
				<td>";
					$result2=mysql_query("SELECT * FROM evszam WHERE id='$row[feladatlap]'");
					$feladatlap=mysql_result ($result2,0,'evho');
					$emelt=mysql_result ($result2,0,'emeltszintu');
				print " $feladatlap
				</td>
				<td>$emelt</td>
				<td> <a href=index.php?id=$row[id]&op=flmod> Módosítás </a></td>
				<td> <a href=index.php?id=$row[id]&op=fltorol> Törlés </a></td>
			</tr>";
		} 
		print "</table>";
	}
	} else {print "A keresett oldal nem található!";}
	?>