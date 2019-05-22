<?php
	require_once '../../db.php';

	$MERK = $MODEL = $KENTEKENNUMMER = $CHASSISNUMMER = $CATEGORIE = $KMSTAND = $ID = '';

	if(isset($_POST["id"]) && !empty($_POST["id"])){

    	$id = $_POST["id"];

    	$status = mysqli_real_escape_string($link, $_POST["status"]);
    	$kmstand = mysqli_real_escape_string($link, $_POST["kmstand"]);

    	$sql = "UPDATE voertuigen SET status='$status', kmstand='$kmstand' WHERE voertuigid = $id ";

    	mysqli_query($link, $sql);
    	header("Location: ../../../voertuigen.php");
    } else {

    	if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

		//$id =  trim($_GET["id"]);

		$sql = "SELECT * FROM voertuigen WHERE voertuigid = ?";

		if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = trim($_GET["id"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $ID = $row['voertuigid'];
                    $MODEL = $row["model"];
                    $MERK = $row["merk"];
                    $KENTEKENNUMMER = $row["plaatnummer"];
                    $CHASSISNUMMER = $row["chassisnummer"];
                    $CATEGORIE = $row["categorie"];
                    $KMSTAND = $row['kmstand'];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
            } else {
            	echo "Oops! Something went wrong. Please try again later.";
            }
        }
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
	} else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
    }


?>
<!DOCTYPE html>
<html>
<head>
	<title>Wijzigen</title>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton|Merriweather|Open+Sans+Condensed:300|Roboto+Condensed" rel="stylesheet">        

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../../../materialize/css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
	<h3 style="font-family: 'Anton', sans-serif; text-align: center;">Wijzigen</h3>
	<br><br>
	<div class="row, container">
		<div class="row">
			<form class="col s12" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
				<div class="row">
					<div class="input-field col s4">
						<input type="text" name="merk" class="validate" value="<?php echo($MERK) ?>" disabled>
						<label for="merk">Merk</label>
					</div>
					<div class="input-field col s4">
						<input type="text" name="model" class="validate" value="<?php echo($MODEL) ?>" disabled>
						<label for="model">Model</label>
					</div>
					<div class="input-field col s4">
						<input type="text" name="kentekennummer" class="validate" value="<?php echo($KENTEKENNUMMER) ?>" disabled>
						<label for="kentekennummer">Kentekennummer</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s8">
						<input type="text" name="chassisnummer" class="validate" value="<?php echo($CHASSISNUMMER) ?>" disabled>
						<label for="chassisnummer">Chassisnummer</label>
					</div>
					<div class="input-field col s4">
						<input type="text" name="categorie" class="validate" value="<?php echo($CATEGORIE) ?>" disabled>
						<label for="categorie">Categorie</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s4">
						<label for="kmstand">Km stand</label>
						<br><br>
						<input type="text" name="kmstand" class="validate" value="<?php echo($KMSTAND) ?>" required>
					</div>
					<div class="input-field col s4">
                		<label for="status">Status</label>
                		<br><br>
                		<select name="status" required>
                    		<option value="binnen">Binnen</option>
                    		<option value="verhuurd">Verhuurd</option>
                  		</select>
                	</div>
                	<div class="input-field col s4">
						<input type="text" name="id" class="validate" value="<?php echo($ID) ?>" hidden>
					</div>
				</div>
				<button class="btn waves-effect waves-light, purple darken-4" type="submit" name="action">Opslaan</button>
				<a href="../../../voertuigen.php">
					<button class="btn waves-effect waves-light, purple darken-4" type="button">Terug</button>
				</a>
			</form>
		</div>
	</div>
</body>
<!-- Import materialize.js -->
<script type="text/javascript" src="../../../materialize/js/materialize.min.js"></script>
<script type="text/javascript">
	M.AutoInit();
</script>
</html>