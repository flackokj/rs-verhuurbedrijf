<?php

	include '../../db.php';

	$ID = $NAAM = $VOERTUIG = $OUDKM = $NIEUWKM = $uDATUM = $iDATUM = $BEDRAG = "";

	if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

		$sql = "SELECT * FROM verhuurd WHERE verhuur_id = ?";

		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "i", $param_id);
			$param_id = trim($_GET["id"]);

			if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result) == 1){
                	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                	$ID = $row['verhuur_id'];
                	$NAAM = $row['klant_naam'];
                	$VOERTUIG = $row['voertuig'];
                	$OUDKM = $row['oudkm'];
                	$NIEUWKM = $row['nieuwkm'];
                	$uDATUM = $row['uitgeef_datum'];
                	$iDATUM = $row['inlever_datum'];
                	$BEDRAG = $row['bedrag'];
                }
            }
		}
		// Close statement
	    mysqli_stmt_close($stmt);
	        
	    // Close connection
	    mysqli_close($link);
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Factuur</title>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton|Merriweather:900|Open+Sans+Condensed:300|Roboto+Condensed:700" rel="stylesheet">        

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../../../materialize/css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <style type="text/css" media="print">
    	body {visibility:visible;}
		.print {visibility:hidden;}
    </style>
</head>
<body>
	<h1 style="font-family: 'Anton', sans-serif; text-align: center; ">Factuur</h1>
	<br><br>

	<div style="padding-left: 50px; padding-right: 50px;">
		<h4 style="font-family: 'Merriweather', serif;">Verhuurder</h4>
	</div>
	<br>
	<div style="padding-left: 80px; padding-right: 80px;">
		<div>
			Naam: RS verhuurbedrijf
			<br>
			Adres: J. Lachmonstraat 413 Paramaribo
			<br>
			Tel. nummer: 472-150
			<!-- <p style="font-family: 'Merriweather', serif;">Huurder</p>
			Naam:
			<br>
			Tel. nummer: -->
		</div>
	</div>
	<br>
	<div style="padding-left: 50px; padding-right: 50px;">
		<hr>
		<h4 style="font-family: 'Merriweather', serif;">Huurder</h4>
	</div>
	<br>
	<div class="row" style="padding-left: 80px; padding-right: 80px;">
		<table class="highlight">
			<tr>
				<td style="font-family: 'Roboto Condensed', sans-serif; font-size: 17px;">Verhuur ID</td>
				<td><?php echo($ID); ?></td>
			</tr>
			<tr>
				<td style="font-family: 'Roboto Condensed', sans-serif; font-size: 17px;">Klantnaam/Bedrijf</td>
				<td><?php echo($NAAM); ?></td>
			</tr>
			<tr>
				<td style="font-family: 'Roboto Condensed', sans-serif; font-size: 17px;">Voertuig</td>
				<td><?php echo($VOERTUIG); ?></td>
			</tr>
			<tr>
				<td style="font-family: 'Roboto Condensed', sans-serif; font-size: 17px;">Oud km</td>
				<td><?php echo($OUDKM); ?></td>
			</tr>
			<tr>
				<td style="font-family: 'Roboto Condensed', sans-serif; font-size: 17px;">Nieuw km</td>
				<td><?php echo($NIEUWKM); ?></td>
			</tr>
			<tr>
				<td style="font-family: 'Roboto Condensed', sans-serif; font-size: 17px;">Uitgeef Datum</td>
				<td><?php echo($uDATUM); ?></td>
			</tr>
			<tr>
				<td style="font-family: 'Roboto Condensed', sans-serif; font-size: 17px;">Inlever Datum</td>
				<td><?php echo($iDATUM); ?></td>
			</tr>
			<tr>
				<td style="font-family: 'Roboto Condensed', sans-serif; font-size: 17px;">Totaal Bedrag</td>
				<td>SRD <?php echo ($BEDRAG); ?></td>
			</tr>
		</table>
		<br><br><br>
		<div>
			Handtekening (klant)
			<br><br><br><br><br>
			Handtekening (bedrijf)
		</div>
		<br><br>
		<div class="fixed-action-btn print">
			<button class="btn waves-effect waves-light purple darken-4" style="border-radius: 50%; height: 60px; width: 60px;" >
				<i onClick="window.print()" class="small material-icons" title="Printen" style='color: #fff;'>print
					<!-- <button onClick="window.print()" class="btn waves-effect waves-light purple darken-4 right" >Printen</button> -->
				</i>
			</button>
		</div>
	</div>
</body>
</html>