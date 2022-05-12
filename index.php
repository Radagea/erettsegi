<?php
	include("adatbazis.php");
	session_start()
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Érettségis weblap</title>
    <link rel="stylesheet" href="style.css">
		<link rel="stylesheet" href="tablazatok.css">
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("h2").eq(0).addClass("active");
				$(".content").eq(0).show();
				$("h2").click(function(){
					$(this).next("div").slideToggle("slow").siblings("div:visible").slideUp("slow");
					$(this).toggleClass("active");
					$(this).siblings("h2").removeClass("active");
				});
			});
		</script>

</head>
<body>
	<header>
		<nav class='clear'>
			<ul>
				<li><a href='index.php'>Főoldal</a></li>
				<?php
				$fck=mysql_query("SELECT * FROM uzenet ORDER BY id");
				$max=0;
				while($row=mysql_fetch_array($fck))
				{
					if ($max<$row[datum])
					{
						$max=$row[datum];
					}
				}
				$osda=mysql_query("SELECT * FROM felhasznalok WHERE id='$_SESSION[login_id]'");
				$last_login=mysql_result($osda,0,'last_login');
				if ($_SESSION[login_jog]==1) {
					print "<li><a href='index.php?op=messages'>Üzenetek"; if($last_login<$max) {print " (1)";} print"</a></li>
					<li><a href='index.php?op=tetelek'>Tételek</a></li>
					";}
				if ($_SESSION[login_jog]==2) { print"
				<li><a href='index.php?op=felh_felvetel'>Felhasználó felvétel</a></li>
				<li><a href='index.php?op=feladat_type'> Feladat típus felvétele</a></li>
				<li><a href='index.php?op=evszam'>Feladatlap hozzáadása</a></li>
				<li><a href='index.php?op=feladat'>Feladat felvétele</a></li>
				<li><a href='index.php?op=csoport'>Csoportok kezelése</a></li>
				<li><a href='index.php?op=teteladd'>Tétel hozzáadása</a></li>
				<li><a href='index.php?op=email'>Emailküldés</a></li>";}
				if (isset($_SESSION[login_id])) {print "
				<li><a href='index.php?op=profilom'>Profilom</a></li>
				<li><a href='logout.php'>Kijelentkezés </a> </li>
				"; }?>
			</ul>
		</nav>
	</header>
	<section>

		<center>
		<?php
		$fck=mysql_query("SELECT * FROM uzenet WHERE id='$_SESSION[login_id]'");
		$osda=mysql_query("SELECT * FROM felhasznalok WHERE id='$_SESSION[login_id]'");
		$eval=mysql_result ($osda,0,'evaltoztatott');
		$last_login=mysql_result($osda,0,'last_login');
		if ($eval==0 && isset($_SESSION[login_id]))
		{
			print "<div style='color: red;'>Kérlek változtass e-mail címet!!</div>";
		}
		if(isset($_GET["op"]) && $_GET["op"]!="") {
			$op = $_GET["op"];
			if(file_exists("inc/".$op.".php")) {
				include_once ("inc/".$op.".php");
			} else {
				include_once ("inc/404.php");
			}
		} else {
			if (isset($_SESSION[login_id])) {
				include_once("inc/main.php");
			} else
			{
				print "
				<form method=POST action=index.php?op=logina enctype=multipart/form-data>
					<table border=0>
					<tr>
						<td colspan=2 align=center> <h3>Bejelentkezés</h3> </td>
					</tr>
					<tr>
						<td> Azonosító </td>
						<td> <input class=input type=text name=azon> </td>
					</tr>
					<tr>
						<td> Jelszó: </td>
						<td> <input class=input type=password name=jelszo> </td>
					</tr>
					<tr>
						<td colspan=2 align=right>
						<input type=submit name=belep value='Bejelentkezés'> </td>
					</tr>
					</table>
				</form>";
			}
		} ?>
		</center>
		</section>
</body>
</html>
