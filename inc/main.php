<?php
	if (isset($_SESSION[login_id])) { print "<div class=bejelent>Üdv $_SESSION[login_nev] !</div>"; }
	if ($_SESSION[login_jog]==2) {
		print "<div id='wrapper'>";
		$result=mysql_query("SELECT * FROM feladat ORDER BY hatarido DESC");
		print mysql_error();
		while($row=mysql_fetch_array($result))
		{
			print "
			<h2>Határidő: $row[hatarido] $row[ido] Feladatlap:";    
				$result2=mysql_query("SELECT * FROM evszam WHERE id='$row[feladatlap]'");
				$feladatlap=mysql_result ($result2,0,'evho');
				$emelt=mysql_result ($result2,0,'emeltszintu');
			print " $feladatlap Típusa: ";  
				$result1=mysql_query("SELECT * FROM feladat_tipus WHERE id='$row[feladattipusa]'");
				$feladattipus=mysql_result ($result1,0,'megnev');
			print " $feladattipus Szintje: $emelt </h2>
			<div class=content>
			 ";
			  $content=mysql_query ("SELECT * FROM megoldasok ORDER BY megoldas");
			  while($row2=mysql_fetch_array($content))
				{
					if ($row[id]==$row2[feladat_id])
					{
					print "<p>";
					$logink=mysql_query("SELECT * FROM felhasznalok WHERE id='$row2[login_id]'");
					$nev=mysql_result ($logink,0,'nev');
					print"<center> Neve: $nev ||    Megjegyzés: $row2[megjegyzes] || <a href='files/megoldasok/$row2[fajlnev]' download>Megoldás letöltése!</a></p></center>";
					}
				}
			 print"
			</div> 
		";
		}
		print "</div>";
		
		
		
	} else {
	print "<table border=1>
			<td>Dátum:</td>
			<td>Idő:</td>
			<td>Feladat típus</td>
			<td>Feladat lap </td>
			<td>Források</td>
			<td>Szint </td>
			<td></td>";
		$datum=date("Y-m-d");
		$ido=date("H:i");
		$result=mysql_query("SELECT * FROM feladat ORDER BY hatarido");
		print mysql_error();
		while($row=mysql_fetch_array($result))
		{
			if ($row[hatarido]>$datum) {
				print "
				<tr>
					<td> $row[hatarido] </td>
					<td> $row[ido] </td>
					<td>";
						$result1=mysql_query("SELECT * FROM feladat_tipus WHERE id='$row[feladattipusa]'");
						$feladattipus=mysql_result ($result1,0,'megnev');
					print" $feladattipus
					</td>
					<td>";
						$result2=mysql_query("SELECT * FROM evszam WHERE id='$row[feladatlap]'");
						$feladatlap=mysql_result ($result2,0,'feladatlap');
						$forras=mysql_result ($result2,0,'forrasfajl');
						$emelt=mysql_result ($result2,0,'emeltszintu');
					print " <a href=files/feladatlapok/$feladatlap download>$feladatlap</a>
					</td>
					<td><a href=files/forrasok/$forras download>$forras</a>
					<td>$emelt</td>
					<td> 
					<a href=index.php?id=$row[id]&op=megold> Megoldás! </a>
					</td>
				</tr>";
			} else
			{ if ($row[hatarido]==$datum){
				if ($row[ido]>$ido) {
					print "
				<tr>
					<td> $row[hatarido] </td>
					<td> $row[ido] </td>
					<td>";
						$result1=mysql_query("SELECT * FROM feladat_tipus WHERE id='$row[feladattipusa]'");
						$feladattipus=mysql_result ($result1,0,'megnev');
					print" $feladattipus
					</td>
					<td>";
						$result2=mysql_query("SELECT * FROM evszam WHERE id='$row[feladatlap]'");
						$feladatlap=mysql_result ($result2,0,'feladatlap');
						$forras=mysql_result ($result2,0,'forrasfajl');
						$emelt=mysql_result ($result2,0,'emeltszintu');
					print " <a href=files/feladatlapok/$feladatlap download>$feladatlap</a>
					</td>
					<td><a href=files/forrasok/$forras download>$forras</a>
					<td>$emelt</td>
					<td> 
						 <a href=index.php?id=$row[id]&op=megold> Megoldás! </a>
					</td>
				</tr>";
				}
				}	
			}
			}
		} 
	print "</table>"; 
?>