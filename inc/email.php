<?php
	if (isset($_SESSION[login_id]) && $_SESSION[login_jog]==2){
	include("adatbazis.php");
	if (isset($_POST[gomb]))
    {
		if ($_POST[csoport]=='mindenki')
		{
			$result=mysql_query("SELECT * FROM felhasznalok ORDER BY nev");
			print mysql_error();
			while($row=mysql_fetch_array($result))
			{
				if ($row[jog]>1)
				{
					
				}else {
					$to      = $row[email];
					$subject = $_POST[subject];
					$message = $_POST[mail];
					$headers = 'From:'. $_SESSION[login_email] . "\r\n" .
							   'Reply-To:'. $_SESSION[login_email] . "\r\n" .
								'X-Mailer: PHP/' . phpversion();

					mail($to, $subject, $message, $headers);
				}
			}
			mysql_query("INSERT INTO uzenet VALUES ('','0','$subject', '$message',now())");
			print mysql_error();
				
		}
		else {
				$result=mysql_query("SELECT * FROM felhasznalok ORDER BY nev");
				print mysql_error();
				while($row=mysql_fetch_array($result))
				{
					if ($row[csopid]==$_POST[csoport] && $row[jog]<2)
					{
					$to      = $row[email];
					$subject = $_POST[subject];
					$message = $_POST[mail];
					$headers = 'From:'. $_SESSION[login_email] . "\r\n" .
							   'Reply-To:'. $_SESSION[login_email] . "\r\n" .
								'X-Mailer: PHP/' . phpversion();

					mail($to, $subject, $message, $headers);
					}
				}
				mysql_query("INSERT INTO uzenet VALUES ('','$_POST[csoport]','$_POST[subject]', '$_POST[mail]',now())");
				print mysql_error();
		}
		print "$_POST[csoport]Mail sikeresen elküldve!";
	}
  else
  {
    print "
    <form method=POST id=asd action=index.php?op=email enctype=multipart/form-data> 
    <table>
      <tr>
        <td colspan=2 align=center> <h3>Email küldése: </h3> </td> 
      </tr>
      <tr>
        <td> Válasz email:  </td>
        <td> $_SESSION[login_email] </td>
      </tr>
	  <tr>
        <td> Ennek a csoportnak:  </td>
        <td> 
			<select name=csoport>
            <option value=mindenki>Mindenkinek</option>
			";
			$result2=mysql_query("SELECT * FROM csoport ORDER BY id");
			print mysql_error();
			while($row2=mysql_fetch_array($result2))
			{
				print "
				<option value=$row2[id]>$row2[neve]</option>";
			
			}
			print "
          </select>
		</td>
      </tr>
	  <tr>
        <td> Tárgy:  </td>
        <td> <input name=subject type=text> </td>
      </tr>
      <tr>
        <td> Tartalom: </td>
        <td> <textarea name=mail placeholder='Ide az emailben küldeni kívánt szöveget' form=asd></textarea> </td>
      </tr>
      <tr>
        <td colspan=2 align=right>
        <input type=submit name=gomb value='Email küldése!'> </td>
      </tr>
	</form>";
  }
  }else {print "A keresett oldal nem található!";}
?>