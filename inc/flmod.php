<?php
	if (isset($_POST[gomb])) {
		
		mysql_query("UPDATE feladat SET 
		hatarido='$_POST[datum]',
		ido='$_POST[ido]',
		feladattipusa='$_POST[f_tipus]',
		feladatlap='$_POST[feladatlap]'
		WHERE id='$_POST[id]'");
		print mysql_error();
		print("A feladat módosítása");
	} else 
	{
		$result=mysql_query("SELECT * FROM feladat WHERE id='$_GET[id]'");
		$hatarido=mysql_result ($result,0,'hatarido');
		$ido=mysql_result ($result,0,'ido'); 
		$feladattipus=mysql_result ($result,0,'feladattipusa');
		$feladatlap=mysql_result ($result,0,'feladatlap');
		print "
			<form method=POST action=index.php?op=flmod enctype=multipart/form-data>
				<table>
					<tr>
						<td colspan=2 align=center> <h3>Feladat módosítása</h3> </td> 
					</tr>     
					<tr>
						<td> Határidő (Dátum): </td>
						<td> <input type=date name=datum value=$hatarido> </td>
					</tr>
					<tr>
						<td> Idő (óra,perc): </td>
						<td> <input type=time name=ido value=$ido> </td>
					</tr>
					<tr>
						<td> Feladat típus: </td>
						<td> 
							<select name=f_tipus>";
							$result1=mysql_query("SELECT * FROM feladat_tipus ORDER BY megnev");
							while($row1=mysql_fetch_array($result1))
							{
								if ($feladattipus==$row1[id]) {
									print"<option value=$row1[id] selected>$row1[megnev]</option>";
								} else 
								{
									print"<option value=$row1[id]>$row1[megnev]</option>";
								}
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
								if ($feladatlap==$row[id]) {
									print"<option value=$row[id] selected>$row[evho] || $row[emeltszintu]</option>";
								} else
								{ print"<option value=$row[id]>$row[evho] || $row[emeltszintu]</option>";}
							}
					print"
							</select>
						</td>
					</tr>
					<tr>
						<td colspan=2 align=center> 
							<input type=hidden name=id value='$_GET[id]'>
							<input type=submit name=gomb value='Feladat felvétele'> </td>
					</tr>
				</table>
			</form> <br><br>
		";
	}
?>